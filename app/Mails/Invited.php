<?php

namespace App\Mails;

use App\Models\Session;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invited extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Session
     */
    public $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('invite')
            ->subject('Uitnodiging video call');
    }
}
