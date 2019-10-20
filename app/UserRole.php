<?php

namespace App\Models;

use App\Models\Campus;
use App\Models\UserType;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $fillable = ['email', 'type_id', 'campus_id'];
    const DEFAULT_ROLE = 1;
    const ADMIN_GENERAL = 4;

    protected static function boot()
    {
        parent::boot();

        UserRole::created(function ($role) {
            $role->updateUserIfExists();
        });

        UserRole::creating(function ($role) {
            if ($role->campus_id === null) {
                $role->campus_id = auth()->user()->campus_id;
            }
        });
    }

    public function scopeForCampus($query, $campus_id)
    {
        return $query->where('campus_id', $campus_id);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'email', 'email');
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\UserType', 'type_id');
    }

    public function delete()
    {
        if ($user = $this->user) {
            $user->update(['type_id' => self::DEFAULT_ROLE]);
        }
        parent::delete();
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function updateUserIfExists()
    {
        if ($this->user) {
            return $this->user->updateType();
        }
    }

    public function setType($type)
    {
        if ($type instanceof UserType) {
            return $this->type()->associate($type);
        }
        
        $this->update(['type_id'=>$type]);
        $this->updateUserIfExists();
    }

    public function setCampus($campus)
    {
        if ($campus instanceof Campus) {
            return $this->campus()->associate($campus);
        }
        
        $this->update(['campus_id'=>$campus]);
        $this->updateUserIfExists();
    }
}
