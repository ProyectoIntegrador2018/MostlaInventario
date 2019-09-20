<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    protected $table = 'reservation_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'reservation_id','product_id','unit_id'
    ];
}
