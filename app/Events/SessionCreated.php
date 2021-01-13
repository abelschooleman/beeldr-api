<?php

namespace App\Events;

use App\Models\Session;

class SessionCreated extends Event
{
    /**
     * @var Session
     */
    public $session;

    /**
     * @var array
     */
    public $invitees;

    /**
     * Create a new event instance.
     *
     * @param Session $session
     * @param array $invitees
     */
    public function __construct(Session $session, array $invitees)
    {
        $this->session = $session;
        $this->invitees = $invitees;
    }
}
