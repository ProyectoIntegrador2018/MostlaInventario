<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function types()
    {
    	return $this->belongsToMany(
    		'App\Models\UserType', 
    		'user_type_permissions', 
    		'permission_id', 
    		'type_id'
    	);
    }
}
