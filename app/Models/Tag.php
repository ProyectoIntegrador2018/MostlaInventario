<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    
    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    protected static function boot()
    {
        parent::boot();

        // Global Scope para que salgan en orden alfabetico siempre.
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('name');
        });
    }

    public function fillInfo($data)
    {
        $this->fill($data);
        $this->save();
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
