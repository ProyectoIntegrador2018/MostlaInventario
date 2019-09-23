<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $table = 'campus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit');
    }
}
