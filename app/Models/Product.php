<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','category_id','tags'
    ];

    public function reservation_details()
    {
        return $this->hasMany('App\Models\ReservationDetail');
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\Category');
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tags');
    }
}
