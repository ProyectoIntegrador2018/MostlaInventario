<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanDetail extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['started_date', 'ended_date'];

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
}
