<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Auth;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private $products, $categories, $tags;

    public function __construct(ProductRepository $products, CategoryRepository $categories, TagRepository $tags)
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function index()
    {
        $products = $this->products->allForUser(auth()->user());
        $categories = $this->categories->allForUser(auth()->user());
        $tags = $this->tags->allForUser();
        
        return view('profile.catalog')->with(compact('products','categories','tags'));
    }

    // $pCategory $pTag
    public function search(Request $request)
    {
        $getproducts = $this->products->findProduct(auth()->user(), $request->name, $request->category, $request->tag)->get();

        return response()->json(array('success' => true, 'getproducts' => $getproducts));
    }

}
