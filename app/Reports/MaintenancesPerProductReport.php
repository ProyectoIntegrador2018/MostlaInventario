<?php

namespace App\Reports;

use App\Models\Maintenance;

class MaintenancesPerProductReport extends Report
{
    protected function query()
    {
        return Maintenance::selectRaw('products.brand, products.name, count(maintenances.id) as maintenance_count')
            ->join('products', 'products.id', '=', 'maintenances.product_id')
            ->groupBy('products.id');
    }

    public function forCampus($campus, $all = false, $permission_all = false)
    {
        if (!($all && $permission_all)) {
            $this->query = $this->query->where('maintenances.campus_id', $campus);
        }
        return $this;
    }
    public function fromDate($value)
    {
        $this->query = $this->query->when($value, function ($query, $date) {
            return $query->where('maintenances.created_at', '>=', $date);
        });
        return $this;
    }

    public function toDate($value)
    {
        $this->query = $this->query->when($value, function ($query, $date) {
            return $query->where('maintenances.created_at', '<=', $date);
        });
        return $this;
    }

    public function mapValues($row)
    {
        return [
            'Marca' => $row->brand,
            'Nombre' => $row->name,
            'Reservaciones' => $row->maintenance_count,
        ];
    }

    protected function filename()
    {
        return 'mantenimientos_por_producto_'.now()->format('Y_m_d').'.xlsx';
    }

    public function getHeadings()
    {
        return [
            'Marca',
            'Nombre',
            'Mantenimientos',
        ];
    }
}
