<?php

namespace App\Reports;

use App\Models\Reservation;

class ReservationsPerProductReport
{
    private $query;

    public function __construct()
    {
        $this->query = Reservation::query();
    }

    public function fromDate($value)
    {
        $this->query->where('created_at', '>=', $value);
        return $this;
    }

    public function toDate($value)
    {
        $this->query->where('created_at', '<=', $value);
        return $this;
    }

    public function getExcel()
    {
        return $this;
    }

    public function getHeadings()
    {
        return [
            'Brand' => 'product.brand',
            'Name' => 'product.name',
        ];
    }
}
