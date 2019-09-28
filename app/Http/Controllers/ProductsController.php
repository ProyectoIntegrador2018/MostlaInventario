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
        $products = $this->product->allForUser();

        return view('profile.products.index')->with(compact($this::STR_PRODS));
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

        $product_new = new Product;
        $product_new->fillInfo($input);
        
        return redirect($this::STR_PRODS);
    }

    public function edit($product_id)
    {
        $product_edit = $this->product->findId($product_id);
        
        return view('profile.products.edit')->with(compact('product_edit'));
    }

    public function update(Request $request, $product_id)
    {
        $input = $request->all();
        $product_update = $this->product->findId($product_id);
        
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

        $product_update->fillInfo($input);
        
        return redirect($this::STR_PRODS);
    }

    public function delete($product_id)
    {
        $product_del = $this->product->findId($product_id);
        $product_del->delete();

        return back();
    }

    public function activate($product_id)
    {
        $product_act = $this->product->findId($product_id);

        $product_act->restore();

        return back();
    }
}
