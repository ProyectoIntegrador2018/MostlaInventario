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
    const RULE_REQ = 'required';
    const STR_CATS = 'categories';

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categoriesIndex = $this->category->all(auth()->user());

        return view('profile.categories.index')->with(compact('categoriesIndex'));
    }

    public function create()
    {
        return view('profile.categories.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'name'             => $this::RULE_REQ
        );

        $messages = array(
            'name.'.$this::RULE_REQ              => 'El nombre es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $categoryNew = new Category;
        $categoryNew->fillInfo($input);
        
        return redirect($this::STR_CATS);
    }

    public function edit($categoryId)
    {
        $categoryEdit = $this->category->findId($categoryId);
        
        return view('profile.categories.edit')->with(compact('categoryEdit'));
    }

    public function update(Request $request, $categoryId)
    {
        $input = $request->all();
        $categoryUpdate = $this->category->findId($categoryId);
        
        $rules = array(
            'name'             => $this::RULE_REQ
        );

        $messages = array(
            'name.'.$this::RULE_REQ              => 'El nombre es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $categoryUpdate->fillInfo($input);
        
        return redirect($this::STR_CATS);
    }

    public function delete($categoryId)
    {
        $categoryDel = $this->category->findId($categoryId);
        $categoryDel->delete();

        return back();
    }

    public function activate($categoryId)
    {
        $categoryAct = $this->category->findId($categoryId);

        $categoryAct->restore();

        return back();
    }
}
