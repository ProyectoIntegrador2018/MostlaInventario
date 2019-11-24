<?php

namespace App\Repositories;

use App\User;
use App\Models\Reservation;

class ReservationRepository
{
    public function forCampus($campus)
    {
        return Reservation::forCampus($campus)
            ->with('product', 'user')
            ->get();
    }

    public function activeForUser($user)
    {
        return Reservation::forUser($user)
            ->active()
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function inactiveForUser($user)
    {
        return Reservation::withTrashed()
            ->forUser($user)
            ->inactive()
            ->with('product', 'loans')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function sameDate($reservation, $user)
    {
        return Reservation::where('product_id', $reservation['product_id'])
            ->where('campus_id', $user->campus->id)
            ->whereIn('status', ['pending','in_progress'])
            ->where(function ($query) use ($day) {
                $query->where(function ($query) use ($reservation) {
                    $query
                        ->where('start_date', '>=', $reservation['start_date'])
                        ->whereBetween('start_date', [$reservation['start_date'],$reservation['end_date']]);
                })->orWhere(function ($query) use ($reservation) {
                    $query
                        ->where('start_date', '>=', $reservation['start_date'])
                        ->where('end_date', '<=', $reservation['end_date']);
                })->orWhere(function ($query) use ($reservation) {
                    $query
                        ->where('start_date', '<=', $reservation['start_date'])
                        ->where('end_date', '>=', $reservation['end_date']);
                })->orWhere(function ($query) use ($reservation) {
                    $query
                        ->where('start_date', '<=', $reservation['start_date'])
                        ->whereBetween('end_date', [$reservation['start_date'],$reservation['end_date']]);
                });
            })
            ->get();
    }

    public function sameDay($day, $productId, $user)
    {
        return Reservation::where('product_id', $productId)
            ->where('campus_id', $user->campus->id)
            ->whereIn('status', ['pending','in_progress'])
            ->where(function ($query) use ($day) {
                $query->where(function ($query) use ($day) {
                    $query->where('start_date', '=', $day);
                })->orWhere(function ($query) use ($day) {
                    $query->where('end_date', '=', $day);
                })->orWhere(function ($query) use ($day) {
                    $query
                        ->where('start_date', '<', $day)
                        ->where('end_date', '>', $day);
                });
            })
            ->get();
    }
}
