<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use SoftDeletes;

    protected $table = 'maintenances';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unit_id', 'comment', 'status'
    ];

    public function scopeForUser($query, $user)
    {
        if ($user === null) {
            return $query;
        }
        
        if ($user->type->isSuperAdmin()) {
            return $query;
        }

        return $query->whereHas('unit', function ($query) use ($user) {
            $query->where('unit.campus_id', $user->campus_id);
        });
    }

    public function unit()
    {
    	return $this->belongsTo('App\Models\Unit');
    }
}