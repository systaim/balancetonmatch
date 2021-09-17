<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Match;
use Illuminate\Notifications\Messages\BroadcastMessage;
use NotificationChannels\WebPush\WebPushChannel;

class matchBegin extends Notification
{
    use Queueable;

    public $match;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Match $match)
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
        return ['database', 'broadcast', WebPushChannel::class];
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
            'text' => "Le match a commencé",
            'homeClub' => $this->match->homeClub->name,
            'awayClub' => $this->match->awayClub->name,
        ];
    }

    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'match_id' => $this->match->id,
            'text' => "Le match a commencé",
            'homeClub' => $this->match->homeClub->name,
            'awayClub' => $this->match->awayClub->name,
        ]);
    }
    public function toWebPush($notifiable, $notification) {
        return (new WebPushMessage)
        ->title('Le match commence')
        ->icon('/approved-icon.png')
        ->body('Your account was approved!')
        ->action('View account', 'view_account')
        ->options(['TTL' => 1000]);
        // ->data(['id' => $notification->id])
        // ->badge()
        // ->dir()
        // ->image()
        // ->lang()
        // ->renotify()
        // ->requireInteraction()
        // ->tag()
        // ->vibrate()
    }
}
