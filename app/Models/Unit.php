<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $fillable = [
        'serial_number','status','product_id','campus_id'
    ];

    public function reservation_details()
    {
        return $this->hasMany('App\Models\ReservationDetail');
    }

    public function product()
    {
    	return $this->belongsTo('App\Models\Product');
    }

    public function campus()
    {
    	return $this->belongsTo('App\Models\Campus');
    }
}
