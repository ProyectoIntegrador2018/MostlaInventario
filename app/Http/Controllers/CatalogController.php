<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Auth;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private $products, $categories;

    public function __construct(ProductRepository $products, CategoryRepository $categories)
    {
        $this->products = $products;
        $this->categories = $categories;
    }

    public function index()
    {
        $products = $this->products->allForUser(auth()->user());
        $categories = $this->categories->allForUser();
        
        return view('profile.catalog')->with(compact('products','categories'));
    }


}
