<?php

namespace App\Notifications;

use App\Notifications\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ReservationCancelledNotice extends Notification
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
                    ->subject('Aviso de Cancelación de Reservación')
                    ->line("Tu reservación de un <strong>{$this->reservation->product->brand} {$this->reservation->product->name}</strong> con fecha de inicio el {$this->reservation->start_date->format('d/M/Y')} as las {$this->reservation->start_date->format('h:i a')} y fecha te terminación el {$this->reservation->end_date->format('d/M/Y')} as las {$this->reservation->end_date->format('h:i a')} ha sido cancelada por un administrador. Una disculpa por las inconveniencias. Comunícate con nosotros para saber más.");
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
