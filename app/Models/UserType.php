<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_types';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title'
    ];

    public function users()
    {
    	return $this->hasMany('App\User', 'type_id');
    }
}
