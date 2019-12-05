<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartItem extends Pivot
{
    protected $guarded = ['id'];
    protected $table = 'cart_items';

    const PENDING = 1;
    const AVAILABLE = 2;
    const UNAVAILABLE = 3;
    const INVALID = 4;

    public function getStartTimeAttribute($value)
    {
        if ($value) {
            return date('H:i', strtotime($value));
        }
        return null;
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }

    public function getEndTimeAttribute($value)
    {
        if ($value) {
            return date('H:i', strtotime($value));
        }
        return null;
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function getStartDatetimeAttribute()
    {
        if ($this->start_date && $this->start_time) {
            return Carbon::parse($this->start_date.' '.$this->start_time);
        }
        return null;
    }

    public function getEndDatetimeAttribute()
    {
        if ($this->end_date && $this->end_time) {
            return Carbon::parse($this->end_date.' '.$this->end_time);
        }
        return null;
    }

    public function validDates()
    {
        if (!$this->start_datetime
            || !$this->end_datetime
            || $this->start_datetime < now()
            || $this->start_time < "08:00" || $this->start_time > "19:00"
            || $this->end_time < "08:00" || $this->end_time > "19:00"
            || !$this->start_datetime->isWeekday()
            || !$this->end_datetime->isWeekday()
        ) {
            return false;
        }

        if (date('Y-m-d', strtotime($this->start_datetime. ' + 7 days')) < date('Y-m-d', strtotime($this->end_datetime))) {
            return false;
        }

        return $this->start_datetime < $this->end_datetime;
    }

    public function setStatus($value)
    {
        $this->update(['status' => $value]);
        return $value;
    }

    public function isAvailable()
    {
        if (!$this->validDates()) {
            return $this->setStatus(self::INVALID);
        }

        $reservations = $this->product->reservations()->forCampus($this->campus_id)->get();
        $starts = $reservations->pluck('start_date')->map(function ($s) {
            return ['date' => $s, 'add' => true];
        });
        $ends = $reservations->pluck('end_date')->map(function ($s) {
            return ['date' => $s, 'add' => false];
        });
        $changes = $starts->concat($ends)->sortBy('date');

        $units = $this->product->units()->forCampus($this->campus_id)->count();
        $count = 0;
        while ($change = $changes->shift()) {
            $count += $change['add'] ? 1 : -1;

            if ($change['date'] > $this->start_datetime && $count >= $units) {
                return $this->setStatus(self::UNAVAILABLE);
            }

            if ($change['date'] > $this->end_datetime) {
                return $this->setStatus(self::AVAILABLE);
            }
        }

        return $this->setStatus(self::AVAILABLE);
    }

    public function submit()
    {
        Reservation::create([
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'campus_id' => $this->campus_id,
            'start_date' => $this->start_datetime,
            'end_date' => $this->end_datetime,
        ]);

        $this->delete();
    }
}
