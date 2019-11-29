<?php

namespace App\Listeners;

use App\Notifications\ReservationCancelledNotice;
use App\Notifications\ReservationConfirmation;
use App\Notifications\ReservationNotice;
use Illuminate\Support\Facades\Notification;

class NotificationSubscriber
{
    public function confirmation($event)
    {
        $user = $event->user;
        $items = $event->items;
        $admins = $items->first()->pivot->campus->roles()->admins()->with('user')->get()->map(function ($role) {
            return $role->user;
        });
        
        Notification::send($user, new ReservationConfirmation($items));
        Notification::send($admins, new ReservationNotice($user, $items));
    }

    public function cancelled($event)
    {
        $reservation = $event->reservation;
        Notification::send($reservation->user, new ReservationCancelledNotice($reservation));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\NewReservation',
            'App\Listeners\NotificationSubscriber@confirmation'
        );

        $events->listen(
            'App\Events\ReservationCancelled',
            'App\Listeners\NotificationSubscriber@cancelled'
        );
    }
}
