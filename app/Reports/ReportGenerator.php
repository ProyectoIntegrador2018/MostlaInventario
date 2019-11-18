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
            case 1:
                return new ReservationsPerProductReport;
            case 2:
                return new ReservationsPerCategoryReport;
            case 3:
                return new ReservationsPerUserReport;
            case 4:
                return new MaintenancesPerProductReport;
        }
    }
}
