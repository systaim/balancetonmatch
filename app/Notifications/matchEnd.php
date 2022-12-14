<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Rencontre;
use Illuminate\Notifications\Messages\BroadcastMessage;

class matchEnd extends Notification
{
    use Queueable;

    public $match;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Rencontre $match)
    {
        $this->match = $match;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'match_id' => $this->match->id,
            'text' => "Le match est terminé",
            'homeClub' => $this->match->homeClub->name,
            'awayClub' => $this->match->awayClub->name,
        ];
    }

    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'match_id' => $this->match->id,
            'text' => "Le match est terminé",
            'homeClub' => $this->match->homeClub->name,
            'awayClub' => $this->match->awayClub->name,
        ]);
    }
}
