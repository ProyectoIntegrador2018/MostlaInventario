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
    const RULE_REQ = 'required';
    const STR_PRODS = 'products';

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $productsIndex = $this->product->allForUser();

        return view('profile.products.index')->with(compact('productsIndex'));
    }

    public function create()
    {
        return view('profile.products.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'name'             => $this::RULE_REQ,
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

        $productNew = new Product;
        $productNew->fillInfo($input);
        
        return redirect($this::STR_PRODS);
    }

    public function edit($productId)
    {
        $productEdit = $this->product->findId($productId);
        
        return view('profile.products.edit')->with(compact('productEdit'));
    }

    public function update(Request $request, $productId)
    {
        $input = $request->all();
        $productUpdate = $this->product->findId($productId);
        
        $rules = array(
            'name'             => $this::RULE_REQ,
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
        
        return redirect($this::STR_PRODS);
    }

    public function delete($productId)
    {
        $productDel = $this->product->findId($productId);
        $productDel->delete();

        return back();
    }

    public function activate($productId)
    {
        $productAct = $this->product->findId($productId);

        $productAct->restore();

        return back();
    }
}
