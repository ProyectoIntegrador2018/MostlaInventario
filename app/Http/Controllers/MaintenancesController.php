<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Maintenance;
use App\Repositories\MaintenanceRepository;
use App\Repositories\UnitRepository;
use Illuminate\Http\Request;
use Validator;

class MaintenancesController extends Controller
{
    private $maintenance;
    const RULE_REQ = 'required';
    const STR_PRODS = 'maintenances';

    public function __construct(MaintenanceRepository $maintenance, UnitRepository $unit)
    {
        $this->maintenance = $maintenance;
        $this->unit = $unit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenances = $this->maintenance->allForUser(auth()->user());
        $st = array(array('id' => '1', 'name' => 'Available'),
                    array('id' => '2', 'name' => 'Unavailable'),
                    array('id' => '3', 'name' => 'Maintenance'),
                    array('id' => '4', 'name' => 'Delete'));
        return view('profile.maintenances.index')->with(compact('maintenances'))->with('status', json_encode($st));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($unitId)
    {
        $unitCreated = $this->unit->findId($unitId);
        return view('profile.maintenances.create')->with(compact('unitCreated'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $unitId = $request->input('unit_id');
        $unitChanged = $this->unit->findId($unitId);

        $rules = array(
            'product_id'           => $this::RULE_REQ,
            'unit_id'           => $this::RULE_REQ,
            'comment'           => 'nullable',
        );

        $messages = array(
            'product_id.'.$this::RULE_REQ           => 'Id de producto es requerido',
            'unit_id.'.$this::RULE_REQ           => 'Id de unit es requerido',
            'comment.'.$this::RULE_REQ           => 'Comentario es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $unitChanged->setStatus('3');
        $maintenanceNew = new Maintenance;
        $maintenanceNew->campus_id = $unitChanged->campus_id;
        $maintenanceNew->fillInfo($input);
        
        return redirect($request->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maintenanceEdit = $this->maintenance->findId($id);

        return view('profile.maintenances.edit')->with(compact('maintenanceEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finish(Maintenance $maintenance)
    {
        $maintenance->unit->setStatus(Unit::AVAILABLE);
        $maintenance->delete();

        return back()->with('alert', 'Se ha dado a la unidad de alta.');
    }

    public function delete(Maintenance $maintenance)
    {
        $maintenance->unit->delete();
        $maintenance->delete();

        return back()->with('alert', 'Se ha eliminado la unidad.');
    }
}
