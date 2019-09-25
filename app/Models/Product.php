<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'brand', 'name', 'category_id','description'
    ];

    public function scopeForUser($query, $user)
    {
        // Reemplazar cuando las reservaciones ya tengan usuarios reales y haya login
        // return $query->where('campus_id', $user->campus->id);
        return $query;
    }

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
