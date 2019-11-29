<?php

namespace App\Notifications;

use App\Notifications\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ReservationNotice extends Notification
{
    private $user;
    private $items;

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $items)
    {
        //
        $this->user = $user;
        $this->items = $items;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
                    ->subject('Nueva Reservación de Equipo')
                    ->line("El usuario <strong>{$this->user->name}</strong> ha reservado los siguientes productos.");
        $mail->table($this->items->map(function ($item) {
            return [
                'Producto' => $item->brand.' '.$item->name,
                'Fecha Inicio' => $item->pivot->start_date.' '.$item->pivot->start_time,
                'Fecha Fin' => $item->pivot->end_date.' '.$item->pivot->end_time,
            ];
        }));

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
