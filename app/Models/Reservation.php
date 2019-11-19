<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    // protected $dateFormat = 'm/d/Y';
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'campus_id', 'start_date', 'end_date', 'status', 'product_id', 'quantity'
    ];
    protected $dates = ['start_date', 'end_date'];

    public function scopeForCampus($query, $campus_id)
    {
        return $query->where('campus_id', $campus_id);
    }

    public function scopeForUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'in_progress']);
    }

    public function scopeInactive($query)
    {
        return $query->whereIn('status', ['cancelled', 'returned']);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }

    public function loans()
    {
        return $this->hasMany('App\Models\LoanDetail');
    }

    public function cancel()
    {
        $this->update(['status'=>'cancelled']);
        $this->delete();
    }

    public function return()
    {
        $this->update(['status'=>'returned']);
        $this->delete();
    }

    public function isPending()
    {
        return $this->status == "pending";
    }

    public function getCanCancelAttribute()
    {
        return $this->isPending() && $this->start_date > now()->addHours(3);
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function setStatus($value)
    {
        if ($value == 'cancelled') {
            return $this->cancel();
        }

        if ($value == 'returned') {
            return $this->return();
        }

        if ($value == 'pending' || $value == 'in_progress') {
            $this->update(['status'=>$value]);
        }
    }

    public static function statuses()
    {
        return [
            'pending' => 'Pendiente',
            'in_progress' => 'En Progreso',
            'returned' => 'Terminada',
            'cancelled' => 'Cancelada',
        ];
    }
}
