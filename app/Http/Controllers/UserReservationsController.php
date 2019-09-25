<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReservationRepository;

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

    	return view('my_reservations')->with(compact('reservations'));
    }

    public function history()
    {
        $reservations = $this->reservations->inactiveForUser(Auth::user());

        return view('reservation_history')->with(compact('reservations'));
    }

    public function cancel(Reservation $reservation)
    {
    	$reservation->cancel();

    	return true;
    }

    public function cancelItem(ReservationDetail $item)
    {
        $item->delete();

        return true;
    }
}
