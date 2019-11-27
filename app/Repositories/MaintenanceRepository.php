<?php
namespace App\Repositories;

use App\Models\Unit;
use App\Models\Maintenance;

class MaintenanceRepository
{
    public function allForUser($user)
    {
        return Maintenance::forUser($user)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    public function findId($maintenanceId)
    {
        return Maintenance::withTrashed()
            ->with('unit')
            ->find($maintenanceId);
    }

    public function all()
    {
        return Maintenance::all();
    }
}
