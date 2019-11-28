<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartItem extends Pivot
{
    protected $guarded = ['id'];
    protected $table = 'cart_items';

    public function getStartTimeAttribute($value)
    {
        if ($value) {
            return date('H:i', strtotime($value));
        }
        return null;
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
        if (!$this->start_datetime || !$this->end_datetime) {
            return true;
        }

        if ($this->start_datetime < now()
            || $this->start_time < "08:00" || $this->start_time > "19:00"
            || $this->end_time < "08:00" || $this->end_time > "19:00"
        ) {
            return false;
        }

        return $this->start_datetime < $this->end_datetime;
    }

    public function isAvailable()
    {
        if (($this->start_date && $this->start_date < now()->toDateString())
            || ($this->end_date && $this->end_date < now()->toDateString())
            || ($this->start_date && $this->end_date
            &&  $this->start_date > $this->end_date)
        ) {
            return 'invalid';
        }

        if (!$this->start_datetime || !$this->end_datetime) {
            return null;
        }

        if (!$this->validDates()) {
            return 'invalid';
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

            if ($change > $this->start_datetime && $count >= $units) {
                return false;
            }

            if ($change > $this->end_datetime) {
                return true;
            }
        }

        return true;
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
