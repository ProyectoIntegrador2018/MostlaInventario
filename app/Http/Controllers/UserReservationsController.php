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

    public function loan(Request $request, Reservation $reservation)
    {
        $reservation->loanUnit($request->unit_id);

        return back();
    }
}
