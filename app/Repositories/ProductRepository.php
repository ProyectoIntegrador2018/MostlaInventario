<?php
namespace App\Repositories;

use App\Models\Campus;
use App\Models\Product;

class ProductRepository
{
    public function allForUser($user)
    {
        return Product::withTrashed()
            ->forUser($user)
            ->orderBy('created_at', 'desc')
            ->with('category')
            ->get();
    }
    
    public function findId($productId)
    {
        return Product::withTrashed()
            ->find($productId);
    }

    public function findProduct($user, $productAttribute, $category, $tag)
    {
        return Product::withTrashed()->forUser($user)->forDetail($productAttribute)->forCategory($category)->forTag($tag);
    }

    public function all()
    {
        return Product::all();
    }
}
