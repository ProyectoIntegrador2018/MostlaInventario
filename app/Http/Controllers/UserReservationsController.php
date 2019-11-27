<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Reservation;
use App\Models\Product;
use App\Repositories\ReservationRepository;
use Auth;
use Illuminate\Http\Request;
use Validator;

class UserReservationsController extends Controller
{
    private $reservations;

    public function __construct(ReservationRepository $reservations)
    {
        $this->reservations = $reservations;
    }

    public function index()
    {
        $reservations = $this->reservations->activeForUser(Auth::user());

        $campus = Campus::all();
        $user_campus = auth()->user()->campus;

        return view('profile.my_reservations')->with(compact('reservations', 'campus', 'user_campus'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $user = auth()->user();

        $rules = array(
            'product_id'                      => 'required|exists:products,id',
            'start_datetime'                  => 'required',
            'end_datetime'                    => 'required'
        );

        $messages = array(
            'product_id.required'              => 'El producto es requerido',
            'product_id.exists'                => 'El producto debe existir',
            'start_datetime.required'          => 'La fecha de inicio es requerida',
            'end_datetime.required'            => 'La fecha de fin es requerida'
        );

        foreach ($input['reservation'] as $res) {
            $validator = Validator::make($res, $rules, $messages);

            if ($validator->fails()) {
                return response()->json($validator->messages(), 400);
            }

            $product = Product::find($res['product_id']);

            $unitsCount = $product->units()->where('campus_id', $user->campus->id)->count();

            //Validate reservation dates
            if ($this->reservations->sameDatetime($res, $user)->count() >= $unitsCount) {
                return response()->json(['message', 'El horario no está disponible.'], 400);
            }
        }

        foreach ($input['reservation'] as $res) {
            $reservation = new Reservation;
            $reservation->fill($res);
            $reservation->user_id = $user->id;
            $reservation->campus_id = $user->campus->id;
            $reservation->status = 'pending';
            $reservation->save();
        }
        
        return response()->json(['message', 'Reservación con éxito.'], 200);
    }

    public function history()
    {
        $reservations = $this->reservations->inactiveForUser(Auth::user());

        return view('profile.reservation_history')->with(compact('reservations'));
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->start_date < now()->addHours(3)) {
            return back()->with('alert', 'No se pueden cancelar reservaciones con menos de 3 horas de anticipación. 
                Por favor comunícate con Mostla.');
        }

        $this->authorize($reservation);

        $reservation->cancel();

        return back()->with('alert', 'Se ha cancelado la reservación exitosamente.');
    }

    public function status(Request $request, $reservation)
    {
        $reservation = Reservation::withTrashed()->findOrFail($reservation);
        $reservation->setStatus($request->status);

        return back();
    }
}
