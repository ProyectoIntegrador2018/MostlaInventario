<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
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
