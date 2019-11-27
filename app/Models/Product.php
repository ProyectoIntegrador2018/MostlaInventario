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
        'brand', 'name', 'category_id','description', 'model'
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

    public function scopeForCampus($query, $campus_id)
    {
        return $query->whereHas('campus', function ($query) use ($campus_id) {
            return $query->where('campus.id', $campus_id);
        });
    }

    public function scopeForDetail($query, $detail)
    {
        return $query->where('name', 'like', '%'.$detail.'%')->orWhere('description', 'like', '%'.$detail.'%');
    }

    public function scopeForCategory($query, $category)
    {
        if ($category == []) {
            return $query;
        }

        return $query->whereIn('category_id', $category);
    }

    public function scopeForTag($query, $tag)
    {
        if ($tag == []) {
            return $query;
        }

        return $query->whereHas('tags', function ($query) use ($tag) {
            $query->whereIn('id', $tag);
        });
    }

    public function fillInfo($data)
    {
        $this->fill($data);
        $this->save();
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
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

    public function deleteFromCampus($campus)
    {
        $this->campus()->detach($campus);
        $this->units()->where('campus_id', $campus)->delete();
    }
}
