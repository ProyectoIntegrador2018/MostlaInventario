<?php
namespace App\Repositories;

use App\Models\Campus;
use App\Models\Product;
use App\Models\Unit;

class UnitRepository
{
    public function allForUser($user)
    {
        return Unit::withTrashed()
            ->forUser($user)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function allForProduct($product)
    {
        return Unit::withTrashed()
            ->forProduct($product)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function findId($unitId)
    {
        return Unit::withTrashed()
            ->with('product')
            ->find($unitId);
    }
}
