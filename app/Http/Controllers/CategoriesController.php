<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Auth;
use Validator;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categoriesIndex = $this->category->allForUser();

        return view('profile.categories.index')->with(compact('categoriesIndex'));
    }

    public function create()
    {
        return view('profile.categories.create');
    }

    public function edit($categoryId)
    {
        $categoriesEdit = $this->category->findId($categoryId);
        
        return view('profile.categories.edit')->with(compact('categoriesEdit'));
    }
}
