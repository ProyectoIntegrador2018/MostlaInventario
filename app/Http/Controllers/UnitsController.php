<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Product;
use App\Repositories\UnitRepository;
use App\Repositories\ProductRepository;
use Auth;
use Validator;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    private $unit;
    private $product;
    const RULE_REQ = 'required';
    const STR_UNITS = 'units';

    public function __construct(UnitRepository $unit, ProductRepository $product)
    {
        $this->unit = $unit;
        $this->product = $product;
    }

    public function index()
    {
        $unitsIndex = $this->unit->allForUser(auth()->user());

        return view('profile.units.index')->with(compact('unitsIndex'));
    }

    public function create(Product $product)
    {
        return view('profile.units.create')->with(compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $input = $request->all();

        $rules = array(
            'serial_number'    => $this::RULE_REQ,
        );

        $messages = array(
            'serial_number.'.$this::RULE_REQ    => 'El numero serial es requerido',
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $unitNew = $product->units()->make($input);
        $unitNew->campus_id = auth()->user()->campus_id;
        // $unitNew->fillInfo($input);
        $unitNew->save();

        return redirect($request->url);
    }

    public function edit($unitId)
    {
        $unitEdit = $this->unit->findId($unitId);
        $products = $this->product->allForUser(auth()->user());
        return view('profile.units.edit')->with(compact('unitEdit', 'products'));
    }

    public function update(Request $request, $unitId)
    {
        $input = $request->all();
        $unitUpdate = $this->unit->findId($unitId);
        $productId = $request->input('product_id');

        $rules = array(
            'serial_number'    => $this::RULE_REQ,
        );

        $messages = array(
            'serial_number.'.$this::RULE_REQ    => 'El numero serial es requerido',
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $unitUpdate->fillInfo($input);

        return redirect('/products/'.$unitUpdate->product_id);
    }

    public function delete($unitId)
    {
        $unitDel = $this->unit->findId($unitId);
        $unitDel->maintenances()->delete();
        $product_id = $unitDel->product_id;
        $unitDel->delete();

        return redirect('/product/edit/'.$product_id);
    }

    public function activate($unitId)
    {
        $unitAct = $this->unit->findId($unitId);

        $unitAct->restore();

        return back();
    }

    public function updateStatus($status)
    {
        if ($status == '4') {
            $this->delete();
        } else {
            $this->setStatus($status);
        }
        return back();
    }
}
