<?php

namespace App\Http\Controllers;

use App\Models\Product;
//use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MaintenanceController extends Controller
{
    public function index()
    {
    	$products = Product::forCampus()->get();
    	return view('maintenance.maintenance')->with(compact('products'));
    }

    public function indexUnit($productId)
    {
        // TODO
        //$units = Unit::forProduct($productId)->get();
        
        //return response()->json(compact('units'), 200);
    }
}
