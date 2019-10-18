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
        'brand', 'name', 'category_id','description', 'campus_id'
    ];

    public function scopeForCampus($query, $campus=null)
    {
        if($campus === null){
            return $query->where('campus_id', auth()->user()->campus_id);
        }
        return $query->where('campus_id', $campus);
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
