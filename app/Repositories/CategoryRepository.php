<?php
namespace App\Repositories;

use App\Models\Campus;
use App\Models\Category;

class CategoryRepository
{
    public function allForUser($user)
    {
        return Category::orderBy('name')->get();
    }
    public function findId($categoryId)
    {
        return Category::find($categoryId);
    }
}
