<?php

namespace App\Policies;

use App\Models\Reservation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    public function cancel(User $user, Reservation $reservation)
    {
        if ($reservation->status != Reservation::PENDING)
            $this->deny("Solo se pueden cancelar reservaciones pendientes.");

        return true;
    }
}
