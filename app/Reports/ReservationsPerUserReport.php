<?php

namespace App\Reports;

use App\Models\Reservation;

class ReservationsPerUserReport extends Report
{
    protected function query()
    {
        return Reservation::withTrashed()->selectRaw('users.name, count(reservations.id) as reservations_count')
            ->join('users', 'users.id', '=', 'reservations.user_id')
            ->groupBy('users.id');
    }

    public function forCampus($campus, $all = false, $permission_all = false)
    {
        if (!($all && $permission_all)) {
            $this->query = $this->query->where('reservations.campus_id', $campus);
        }
        return $this;
    }
    public function fromDate($value)
    {
        $this->query = $this->query->when($value, function ($query, $date) {
            return $query->where('reservations.created_at', '>=', $date);
        });
        return $this;
    }

    public function toDate($value)
    {
        $this->query = $this->query->when($value, function ($query, $date) {
            return $query->where('reservations.created_at', '<=', $date);
        });
        return $this;
    }

    public function mapValues($row)
    {
        return [
            'Nombre' => $row->name,
            'Reservaciones' => $row->reservations_count,
        ];
    }

    protected function filename()
    {
        return 'reservaciones_por_usuario_'.now()->format('Y_m_d').'.xlsx';
    }

    public function getHeadings()
    {
        return [
            'Nombre',
            'Reservaciones',
        ];
    }
}
