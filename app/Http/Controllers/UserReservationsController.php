<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Repositories\ReservationRepository;
use Auth;
use Illuminate\Http\Request;

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
        $this->authorize($reservation);

        $reservation->cancel();

        return back();
    }

    public function cancelItem(ReservationDetail $item)
    {
        $item->delete();

        return true;
    }
}
