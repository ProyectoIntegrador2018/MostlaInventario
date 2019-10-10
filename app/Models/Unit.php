<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $fillable = [
        'serial_number','status','product_id','campus_id'
    ];

    public function scopeForUser($query)//, $user)
    {
        // Reemplazar cuando las reservaciones ya tengan usuarios reales y haya login
        //  query -> where('campus_id', $user->campus->id)
        return $query;
    }

    public function scopeForProduct($query)//, $product)
    {
        // Reemplazar cuando las reservaciones ya tengan usuarios reales y haya login
        //  query -> where('product_id', $product->id)
        return $query;
    }

    public function fillInfo($data)
    {
        $this->fill($data);
        $this->save();
    }

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
