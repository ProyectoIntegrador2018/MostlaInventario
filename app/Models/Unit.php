<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $fillable = [
        'serial_number','comments','status','product_id','campus_id'
    ];

    const AVAILABLE = 1;
    const UNAVAILABLE = 2;
    const MAINTENANCE = 3;

    public function scopeForUser($query, $user)
    {
        if ($user === null) {
            return $query;
        }
        
        if ($user->type->isSuperAdmin()) {
            return $query;
        }

        return $query->whereHas('campus', function ($query) use ($user) {
            $query->where('campus.id', $user->campus_id);
        });
    }

    public function scopeAlive($query)
    {
        return $query->where('status', '!=', self::MAINTENANCE);
    }

    public function scopeForCampus($query, $campus)
    {
        return $query->where('campus_id', $campus);
    }

    public function scopeForProduct($query, $product)
    {
        if ($product === null) {
            return $query;
        }
        
        return $query->where('product_id', $product->id);
    }

    public function fillInfo($data)
    {
        $this->fill($data);
        $this->save();
    }

    public function loan()
    {
        return $this->hasOne('App\Models\LoanDetail')->orderBy('created_at', 'desc');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }

    public function maintenances()
    {
        return $this->hasMany('App\Models\Maintenance');
    }

    public function setStatus($status)
    {
        return $this->update(['status'=>$status]);
    }
}
