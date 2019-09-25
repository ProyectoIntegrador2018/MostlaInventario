<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationDetail extends Model
{
    use SoftDeletes;

    protected $table = 'reservation_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'reservation_id', 'product_id', 'unit_id'
    ];

    public function reservation()
    {
    	return $this->belongsTo('App\Models\Reservation');
    }

    public function product()
    {
    	return $this->belongsTo('App\Models\Product');
    }

    public function unit()
    {
    	return $this->belongsTo('App\Models\Unit');
    }
}
