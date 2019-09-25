<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Auth;
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

    public function edit($id)
    {
        $product = $this->product->findId($id);
        
    	return view('profile.products.edit')->with(compact('product'));
    }

    public function delete($id)
    {
        $product = $this->product->findId($id);
    	$product->delete();

    	return back();
    }

    public function activate($id)
    {
        $product = $this->product->findId($id);

    	$product->restore();

    	return back();
    }
}
