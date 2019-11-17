<?php

namespace App\Reports;

use App\Models\Maintenance;
use App\Models\Product;
use App\Models\Reservation;

class ReportGenerator
{
    protected $types = [
        'Reservaciones por Producto',
        'Reservaciones por Tendencia',
        'Reservaciones por Usuario',
        'Mantenimientos por Producto',
    ];

    public function types()
    {
        return $this->types;
    }

    public function ofType($type)
    {
        switch ($type) {
            case 0:
                return new ReservationsPerProductReport;
            case 1:
            case 2:
            case 3:
        }
    }
}
