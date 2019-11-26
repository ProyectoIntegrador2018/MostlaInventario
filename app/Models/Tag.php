<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    
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
