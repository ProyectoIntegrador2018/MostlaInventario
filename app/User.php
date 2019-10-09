<?php

namespace App;

use App\Models\UserType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\UserType', 'type_id');
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function setType($type)
    {
        if ($type instanceof UserType) {
            return $this->type()->associate($type);
        }
        
        $this->update(['type_id'=>$type]);
    }
}
