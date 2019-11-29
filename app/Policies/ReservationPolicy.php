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
        if ($user->type_id > 1) {
            return true;
        }

        if ($reservation->status != 'pending') {
            $this->deny("Solo se pueden cancelar reservaciones pendientes.");
        }

        if ($reservation->start_date < now()->addHours(3)) {
            $this->deny("No se puede cancelar reservaciones con menos de 3 horas de anticipación. 
            	Por favor comunícate con Mostla.");
        }

        return true;
    }
}
