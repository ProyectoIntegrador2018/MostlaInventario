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

    public function create()
    {
        $products = $this->product->allForUser(auth()->user());
        return view('profile.units.create')->with(compact('products'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $productId = $request->input('product_id');


        $rules = array(
            'product_id'       => $this::RULE_REQ.'|exists:products,id',
            'serial_number'    => $this::RULE_REQ,
            'status'           => $this::RULE_REQ
        );

        $messages = array(
            'product_id.'.$this::RULE_REQ       => 'El producto es requerido',
            'product_id.exists'                 => 'El producto debe existir',
            'serial_number.'.$this::RULE_REQ    => 'El numero serial es requerido',
            'status.'.$this::RULE_REQ           => 'El estatus es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $unitNew = new Unit;
        $unitNew->campus_id = auth()->user()->campus->id;
        $unitNew->fillInfo($input);

        return redirect('/product/edit/'.$productId);
    }

    public function edit($unitId)
    {
        $unitEdit = $this->unit->findId($unitId);

        return redirect('/product/edit/'.$unitEdit->product_id);
    }

    public function update(Request $request, $unitId)
    {
        $input = $request->all();
        $unitUpdate = $this->unit->findId($unitId);

        $rules = array(
            'serial_number'    => $this::RULE_REQ,
            'status'           => $this::RULE_REQ
        );

        $messages = array(
            'serial_number.'.$this::RULE_REQ    => 'El numero serial es requerido',
            'status.'.$this::RULE_REQ           => 'El campus es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $unitUpdate->fillInfo($input);

        return back();
    }

    public function delete($unitId)
    {
        $unitDel = $this->unit->findId($unitId);
        $unitDel->delete();

        return back();
    }

    public function activate($unitId)
    {
        $unitAct = $this->unit->findId($unitId);

        $unitAct->restore();

        return back();
    }

    public function updateStatus($status)
    {
        if($status == '4'){
            $this->delete();
        }
        else{
            $this->setStatus($status);
        }
        return back();
    }
}
