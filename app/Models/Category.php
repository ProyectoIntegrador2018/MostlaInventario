<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function scopeForUser($query)//, $user)
    {
        // Reemplazar cuando las reservaciones ya tengan usuarios reales y haya login
        //  query -> where('campus_id', $user->campus->id)
        return $query;
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
