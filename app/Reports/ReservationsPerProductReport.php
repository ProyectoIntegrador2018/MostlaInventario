<?php

namespace App\Reports;

use App\Models\Reservation;

class ReservationsPerProductReport extends Report
{
    protected function query()
    {
        return Reservation::withTrashed()->selectRaw('products.brand, products.name, categories.name as category, count(reservations.id) as reservations_count')
            ->join('products', 'products.id', '=', 'reservations.product_id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->groupBy('products.id');
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
            'Marca' => $row->brand,
            'Nombre' => $row->name,
            'Categoría' => $row->category,
            'Reservaciones' => $row->reservations_count,
        ];
    }

    protected function filename()
    {
        return 'reservaciones_por_producto_'.now()->format('Y_m_d').'.xlsx';
    }

    public function getHeadings()
    {
        return [
            'Marca',
            'Nombre',
            'Categoría',
            'Reservaciones',
        ];
    }
}
