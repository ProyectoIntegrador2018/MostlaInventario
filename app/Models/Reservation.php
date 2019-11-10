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
        'user_id', 'campus_id', 'start_date', 'end_date', 'status'
    ];
    protected $dates = ['start_date', 'end_date'];

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
}
