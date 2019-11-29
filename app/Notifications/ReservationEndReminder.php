<?php

namespace App\Notifications;

use App\Notifications\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ReservationEndReminder extends Notification
{
    private $reservation;

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reservation)
    {
        //
        $this->reservation = $reservation;
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
        return (new MailMessage)
                    ->subject('Recordatorio de Fin de Reservación')
                    ->line("Te recordamos que tu reservación de un <strong>{$this->reservation->product->brand} {$this->reservation->product->name}</strong> tiene fecha te terminación el {$this->reservation->end_date->format('d/M/Y')} as las {$this->reservation->end_date->format('h:i a')}. Por favor, asegúrate de regresar el equipo a tiempo.");
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
