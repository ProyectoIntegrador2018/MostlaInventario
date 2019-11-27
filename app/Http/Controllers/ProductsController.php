<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Unit;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\UnitRepository;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class ProductsController extends Controller
{
    private $product;
    private $category;
    const RULE_REQ = 'required';
    const STR_PRODS = 'products';

    public function __construct(ProductRepository $product, CategoryRepository $category, UnitRepository $unit)
    {
        $this->product = $product;
        $this->category = $category;
        $this->unit = $unit;
    }

    public function index(Request $request)
    {
        $productsIndex = Product::forUser(auth()->user())
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
            ->get();

        $categories = Category::all();
        $tags = Tag::all();

        $request->session()->flashInput($request->input());
        return view('profile.products.index')->with(compact('productsIndex', 'categories', 'tags'));
    }

    public function create()
    {
        $categories = $this->category->all();
        $tags = Tag::all();
        $products = $this->product->all();

        return view('profile.products.create')->with(compact('categories', 'products', 'tags'));
    }

    public function store(Request $request)
    {
        $input = $request->except('tags');
        $tags = $request->input('tags');

        $rules = array(
            'name'             => $this::RULE_REQ,
            'model'            => 'nullable',
            'brand'            => $this::RULE_REQ,
            'description'      => $this::RULE_REQ,
            'category_id'      => $this::RULE_REQ
        );

        $messages = array(
            'name.'.$this::RULE_REQ              => 'El nombre es requerido.',
            'brand.'.$this::RULE_REQ                 => 'La marca es requerida.',
            'description.'.$this::RULE_REQ           => 'La descripción es requerida.',
            'category_id.'.$this::RULE_REQ      => 'La categoría es requerida.'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $productNew = new Product;
        $productNew->fillInfo($input);
        $productNew->tags()->attach($tags);
        $productNew->campus()->save(auth()->user()->campus);

        return redirect($this::STR_PRODS);
    }

    public function edit($productId)
    {
        $productEdit = $this->product->findId($productId);
        $categories = Category::all();
        $tags = Tag::all();
        $units = $this->unit->allForProductInCampus($productEdit, auth()->user());
        $ptags = $productEdit->tags->map(function ($t) {
            return $t->id;
        })->toArray();

        return view('profile.products.edit')->with(compact('productEdit', 'categories', 'ptags', 'tags', 'units'));
    }

    public function update(Request $request, $productId)
    {
        $input = $request->except('tags');
        $tags = $request->input('tags');
        $productUpdate = $this->product->findId($productId);

        $rules = array(
            'name'             => $this::RULE_REQ,
            'model'            => 'nullable',
            'brand'            => $this::RULE_REQ,
            'description'      => $this::RULE_REQ,
            'category_id'      => $this::RULE_REQ
        );

        $messages = array(
            'name.'.$this::RULE_REQ              => 'El nombre es requerido',
            'brand.'.$this::RULE_REQ                 => 'La marca es requerida',
            'description.'.$this::RULE_REQ           => 'La descripción es requerida',
            'category_id.'.$this::RULE_REQ      => 'La categoria es requerida'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $productUpdate->fillInfo($input);
        $productUpdate->tags()->sync($tags);

        return redirect($this::STR_PRODS);
    }

    public function delete($productId)
    {
        $productDel = $this->product->findId($productId);
        $productDel->delete();

        return back();
    }

    public function attach(Product $product)
    {
        $product->addToCampus(auth()->user()->campus_id);

        return redirect('/products/'.$product->id);
    }

    public function detach(Product $product)
    {
        $product->deleteFromCampus(auth()->user()->campus_id);

        return redirect('/products');
    }

    public function show(Product $product)
    {
        $categories = Category::all();
        $product->load('units');


        return view('profile.products.show')->with(compact('product', 'categories'));
    }

    public function search(Request $request)
    {
        $getproducts = $this->products->findProduct(auth()->user(), $request->name, $request->category, $request->tag)->get();

        return response()->json(array('success' => true, 'getproducts' => $getproducts));
    }
}
