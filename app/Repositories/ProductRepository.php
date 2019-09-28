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
    public function findId($product_id)
    {
        return Product::withTrashed()
            ->find($product_id);
    }
}
