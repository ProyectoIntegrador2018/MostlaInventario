<?php
namespace App\Repositories;

use App\Models\Campus;
use App\Models\Category;

class CategoryRepository
{
    public function allForUser()//($user)
    {
        return Category::withTrashed()
            ->forUser()//->forUser($user)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function findId($categoryId)
    {
        return Category::withTrashed()
            ->find($categoryId);
    }
}
