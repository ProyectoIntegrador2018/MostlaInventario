<?php 

namespace App\Repositories;

use App\User;
use App\Models\Reservation;

class ReservationRepository {

	public function activeForUser(App\User $user)
	{
		return Reservation::forUser($user)->active()->get();
	}

	public function inactiveForUser(App\User $user)
	{
		return Reservation::withTrashed()->forUser($user)->inactive()->get();
	}
}
