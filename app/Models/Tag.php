<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
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
    	return $this->belongsToMany('App\Models\Product');
    }
}
