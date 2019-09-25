<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id','campus_id','start_date','end_date', 'status'
    ];

    public function scopeForUser($query, $user)
    {
        // Reemplazar cuando las reservaciones ya tengan usuarios reales y haya login
        // return $query->where('user_id', $user->id);
        return $query;
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

    public function details()
    {
        return $this->hasMany('App\Models\ReservationDetail');
    }

    public function all_details()
    {
        return $this->hasMany('App\Models\ReservationDetail')->withTrashed();
    }

    public function cancel()
    {
        $this->update(['status'=>'cancelled']);
        $this->delete();
    }
}
