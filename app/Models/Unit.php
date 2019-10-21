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
        'serial_number','status','product_id','campus_id'
    ];

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

    public function reservation_details()
    {
        return $this->hasMany('App\Models\ReservationDetail');
    }

    public function product()
    {
    	return $this->belongsTo('App\Models\Product');
    }

    public function campus()
    {
    	return $this->belongsTo('App\Models\Campus');
    }
}
