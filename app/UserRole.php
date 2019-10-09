<?php

namespace App;

use App\Models\UserType;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $fillable = ['email', 'type_id'];
    const DEFAULT_ROLE = 1;

    public function user()
    {
        return $this->belongsTo('App\User', 'email', 'email');
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

    public function setType($type)
    {
        if ($type instanceof UserType) {
            return $this->type()->associate($type);
        }
        
        $this->update(['type_id'=>$type]);

        if ($user = User::where('email', $this->email)->first()) {
            $user->setType($type);
        }
    }
}
