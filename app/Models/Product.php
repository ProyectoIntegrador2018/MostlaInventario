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
        if ($user === null) {
            return $query;
        }
        
        if ($user->type->isSuperAdmin()) {
            return $query;
        }

        return $query->whereHas('campus', function ($query) use ($user) {
            $query->where('campus.id', $user->campus_id);
        });
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
        return $this->belongsToMany('App\Models\Tag');
    }

    public function campus()
    {
        return $this->belongsToMany('App\Models\Campus');
    }

    public function addToCampus($campus)
    {
        $this->campus()->syncWithoutDetaching([$campus]);
    }
}
