<?php 

namespace App\Repositories;

use App\User;
use App\Models\Reservation;

class ReservationRepository {

	public function activeForUser($user)
	{
		return Reservation::forUser($user)
			->active()
			->with('details.product')
			->orderBy('created_at', 'desc')
			->get();
	}

	public function inactiveForUser($user)
	{
		return Reservation::withTrashed()
			->forUser($user)
			->inactive()
			->with('all_details.product')
			->orderBy('created_at', 'desc')
			->get();
	}
}
