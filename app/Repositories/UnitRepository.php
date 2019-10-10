<?php
namespace App\Repositories;

use App\Models\Campus;
use App\Models\Product;
use App\Models\Unit;

class UnitRepository
{
    public function allForUser()//($user)
    {
        return Unit::withTrashed()
            ->forUser()//->forUser($user)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function allForProduct()//($user)
    {
        return Unit::withTrashed()
            ->forProduct()//->forUser($user)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function findId($unitId)
    {
        return Unit::withTrashed()
            ->find($unitId);
    }
}
