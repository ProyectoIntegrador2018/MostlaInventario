<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Auth;
use Validator;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->allForUser(Auth::user());

        return view('profile.products.index')->with(compact('products'));
    }

    public function create()
    {
        return view('profile.products.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'name'             => 'required',
            'brand'            => 'required',
            'description'      => 'required',
            'category_id'      => 'required'
        );

        $messages = array(
            'name.required'              => 'El nombre es requerido',
            'brand.required'                 => 'La marca es requerida',
            'description.required'           => 'La descripción es requerida',
            'category_id.required'      => 'La categoria es requerida'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $product = new Product;
        $product->fillInfo($input);
        
        return redirect('products');
    }

    public function edit($product_id)
    {
        $product = $this->product->findId($product_id);
        
        return view('profile.products.edit')->with(compact('product'));
    }

    public function update(Request $request, $product_id)
    {
        $input = $request->all();
        $product = $this->product->findId($product_id);
        
        $rules = array(
            'name'             => 'required',
            'brand'            => 'required',
            'description'      => 'required',
            'category_id'      => 'required'
        );

        $messages = array(
            'name.required'              => 'El nombre es requerido',
            'brand.required'                 => 'La marca es requerida',
            'description.required'           => 'La descripción es requerida',
            'category_id.required'      => 'La categoria es requerida'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $product->fillInfo($input);
        
        return redirect('products');
    }

    public function delete($product_id)
    {
        $product = $this->product->findId($product_id);
        $product->delete();

        return back();
    }

    public function activate($product_id)
    {
        $product = $this->product->findId($product_id);

        $product->restore();

        return back();
    }
}
