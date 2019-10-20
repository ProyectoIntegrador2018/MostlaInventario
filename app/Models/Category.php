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
