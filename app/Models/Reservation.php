<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id','campus_id','start_date','end_date','status'
    ];

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
}
