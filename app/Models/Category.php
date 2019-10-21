<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // use SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
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

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
