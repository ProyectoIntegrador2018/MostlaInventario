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
            'start_date'                      => 'required',
            'end_date'                        => 'required'
        );

        $messages = array(
            'product_id.required'              => 'El producto es requerido',
            'product_id.exists'                 => 'El producto debe existir',
            'start_date.required'              => 'La fecha de inicio es requerida',
            'end_date.required'                => 'La fecha de fin es requerida'
        );

        foreach ($input['reservation'] as $res) {
            $validator = Validator::make($res, $rules, $messages);

            if ($validator->fails()) {
                dd($res);
                return response()->json($validator->messages(), 400);
            }

            $product = Product::find($res['product_id']);

            $unitsCount = $product->units()->where('campus_id', $user->campus->id)->count();

            //Validate reservation dates
            $start = new \DateTime($res['start_date']);
            $end = new \DateTime($res['end_date']);

            for ($day = $start; $day <= $end; $day->modify('+1 day')) {
                if ($this->reservations->sameDay($day, $product->id, $user)->count() >= $unitsCount) {
                    return response()->json(['message', 'El dia '.$day->format('Y-m-d').' no esta disponible'], 400);
                }
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
        ;
    }

    public function history()
    {
        $reservations = $this->reservations->inactiveForUser(Auth::user());

        return view('profile.reservation_history')->with(compact('reservations'));
    }

    public function cancel(Reservation $reservation)
    {
        $this->authorize($reservation);

        $reservation->cancel();

        return back();
    }

    public function status(Request $request, $reservation)
    {
        $reservation = Reservation::withTrashed()->findOrFail($reservation);
        $reservation->setStatus($request->status);

        return back();
    }
}
