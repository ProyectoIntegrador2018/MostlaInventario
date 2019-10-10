<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Repositories\UnitRepository;
use Auth;
use Validator;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    private $unit;
    const RULE_REQ = 'required';
    const STR_UNITS = 'units';

    public function __construct(UnitRepository $unit)
    {
        $this->unit = $unit;
    }

    public function index()
    {
        $unitsIndex = $this->unit->allForUser();

        return view('profile.units.index')->with(compact('unitsIndex'));
    }

    public function create()
    {
        return view('profile.units.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'product_id'       => $this::RULE_REQ.'|exists:products,id',
            'serial_number'    => $this::RULE_REQ,
            'campus_id'        => $this::RULE_REQ
        );

        $messages = array(
            'product_id.'.$this::RULE_REQ       => 'El producto es requerido',
            'product_id.exists'                 => 'El producto debe existir',
            'serial_number.'.$this::RULE_REQ    => 'El numero serial es requerido',
            'campus_id.'.$this::RULE_REQ        => 'El campus es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $unitNew = new Unit;
        $unitNew->fillInfo($input);
        
        return redirect($this::STR_UNITS);
    }

    public function edit($unitId)
    {
        $unitEdit = $this->unit->findId($unitId);
        
        return view('profile.units.edit')->with(compact('unitEdit'));
    }

    public function update(Request $request, $unitId)
    {
        $input = $request->all();
        $unitUpdate = $this->unit->findId($unitId);
        
        $rules = array(
            'product_id'       => $this::RULE_REQ.'|exists:products,id',
            'serial_number'    => $this::RULE_REQ,
            'campus_id'        => $this::RULE_REQ
        );

        $messages = array(
            'product_id.'.$this::RULE_REQ       => 'El producto es requerido',
            'product_id.exists'                 => 'El producto debe existir',
            'serial_number.'.$this::RULE_REQ    => 'El numero serial es requerido',
            'campus_id.'.$this::RULE_REQ        => 'El campus es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $unitUpdate->fillInfo($input);
        
        return redirect($this::STR_UNITS);
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
}
