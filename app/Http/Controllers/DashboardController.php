<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Repositories\ReservationRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $reservations;

    public function __construct(ReservationRepository $reservations)
    {
        $this->reservations = $reservations;
    }

    public function index(Request $request)
    {
        $reservations = Reservation::forCampus(auth()->user()->campus_id)
            ->with('product', 'user')
            ->when($request->status, function ($query, $status) {
                if ($status == 'returned' || $status == 'cancelled') {
                    $query = $query->withTrashed()->where('updated_at', '>', now()->startOfDay());
                }
                return $query->where('status', $status);
            })
            ->get();
        $statuses = Reservation::statuses();
        $filters = $request->all();

        return view('dashboard.index')->with(compact('reservations', 'statuses', 'filters'));
    }

    public function remind()
    {
        // Mandar email a usuarios cuyas reservaciones se terminan en un dia, el mismo dia
        // o que ya hayan expirado y siguen sin regresar.

        return back()->with('alert', 'Se han enviado los recordatorios.');
    }
}
