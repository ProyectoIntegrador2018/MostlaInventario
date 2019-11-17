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

    const COORDINATOR = 2;
    const ADMIN = 3;
    const SUPER_ADMIN = 4;

    public function scopeLesserThan($query, $type)
    {
        return $query->where('id', '<', $type);
    }

    public function users()
    {
        return $this->hasMany('App\User', 'type_id');
    }

    public function isSuperAdmin()
    {
        return $this->id == self::SUPER_ADMIN;
    }
}
