<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TagRepository;
use Auth;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private $products;
    private $categories;
    private $tags;

    public function __construct(ProductRepository $products, CategoryRepository $categories, TagRepository $tags)
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function index(Request $request)
    {
        $products = Product::forCampus(auth()->user()->campus_id)
            ->when($request->search, function ($query, $string) {
                return $query->where('name', 'like', "%$string%")
                    ->orWhere('model', 'like', "%$string%")
                    ->orWhere('description', 'like', "%$string%")
                    ->orWhere('brand', 'like', "%$string%");
            })
            ->when(!empty($request->categories), function ($query) use ($request) {
                return $query->whereIn('category_id', $request->categories);
            })
            ->when(!empty($request->tags), function ($query) use ($request) {
                return $query->whereHas('tags', function ($query) use ($request) {
                    return $query->whereIn('tags.id', $request->tags);
                });
            })
            ->orderBy('created_at', 'desc')
            ->with('category')
            // ->withCount('units')
            // ->having('units_count', '>', 0)
            ->get();
        $cart = auth()->user()->cart->pluck('id');
        $categories = $this->categories->all();
        $tags = $this->tags->all();
        
        $request->session()->flashInput($request->input());
        return view('profile.catalog')->with(compact('products', 'categories', 'tags', 'cart'));
    }

    // $pCategory $pTag
    public function search(Request $request)
    {
        $getproducts = $this->products->findProduct(auth()->user(), $request->name, $request->category, $request->tag)->get();

        return response()->json(array('success' => true, 'getproducts' => $getproducts));
    }
}
