<?php

namespace App\Http\Controllers;
use App\Models\Unit;
use App\Models\Maintenance;
use App\Repositories\MaintenanceRepository;
use Illuminate\Http\Request;

class MaintenancesController extends Controller
{
    private $maintenance;
    const RULE_REQ = 'required';
    const STR_PRODS = 'maintenances';

    public function __construct(MaintenanceRepository $maintenance)
    {
        $this->maintenance = $maintenance;
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
    public function create()
    {
        //
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

        $rules = array(
            'unit_id'           => $this::RULE_REQ,
            'status'            => $this::RULE_REQ,
            'comment'           => $this::RULE_REQ,
        );

        $messages = array(
            'unit_id.'.$this::RULE_REQ           => 'Id de unit es requerido',
            'status.'.$this::RULE_REQ            => 'Estado es requerido',
            'comment.'.$this::RULE_REQ           => 'Comentario es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $maintenanceNew = new Maintenance;
        $maintenanceNew->fillInfo($input);
        
        return redirect($this::STR_PRODS);
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
    public function updateStatus(Request $request, Unit $unit)
    {
        $status = $request->input('status');
        $unit->setStatus($status);

        return back();
    }

}
