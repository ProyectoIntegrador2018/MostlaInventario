<?php
namespace App\Repositories;

use App\Models\Campus;
use App\Models\Product;

class ProductRepository
{
    public function allForUser()//($user)
    {
        return Product::withTrashed()
            ->forUser()//->forUser($user)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function findId($productId)
    {
        return Product::withTrashed()
            ->find($productId);
    }
}
