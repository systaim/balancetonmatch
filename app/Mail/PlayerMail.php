<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlayerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $player;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $player)
    {
        $this->player = $player;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@balancetonmatch.com')
            ->view('mails.player');
    }
}
