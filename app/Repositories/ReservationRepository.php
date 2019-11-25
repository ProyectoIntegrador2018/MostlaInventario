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

    public static function sameDatetime($reservation, $user)
    {
        return Reservation::where('product_id', $reservation['product_id'])
            ->where('campus_id', $user->campus->id)
            ->whereIn('status', ['pending','in_progress'])
            ->where(function ($query) use ($reservation) {
                $query->where(function ($query) use ($reservation) {
                    /*Cases:
                    Reservation request:
                            |------------------|
                    exist       |---------|
                    exist       |--------------------|
                    */
                    $query
                        ->where('start_datetime', '>=', $reservation['start_datetime'])
                        ->whereBetween('start_datetime', [$reservation['start_datetime'],$reservation['end_datetime']]);
                })->orWhere(function ($query) use ($reservation) {
                    /*Cases:
                    Reservation request:
                                |------------------|
                    exist   |---------------|
                    */
                    $query
                        ->where('start_datetime', '<=', $reservation['start_datetime'])
                        ->whereBetween('end_datetime', [$reservation['start_datetime'],$reservation['end_datetime']]);
                })->orWhere(function ($query) use ($reservation) {
                    /*Case:
                    Reservation request:
                                |------------------|
                    exist   |--------------------------|
                    */
                    $query
                        ->where('start_datetime', '<=', $reservation['start_datetime'])
                        ->where('end_datetime', '>=', $reservation['end_datetime']);
                });
            })
            ->get();
    }
}
