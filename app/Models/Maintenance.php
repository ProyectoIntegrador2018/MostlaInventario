<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use SoftDeletes;

    protected $table = 'maintenance';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unit_id', 'comment', 'campus_id'
    ];

    public function unit()
    {
    	return $this->belongsTo('App\Models\Unit');
    }

    public function campus()
    {
    	return $this->belongsTo('App\Models\Campus');
    }
}
