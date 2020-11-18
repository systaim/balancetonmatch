<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffMail extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($staff)
    {
        $this->staff = $staff;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@btm.com')
            ->view('mails.staff');
    }
}
