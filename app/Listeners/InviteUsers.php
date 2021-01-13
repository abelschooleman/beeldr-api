<?php

namespace App\Listeners;

use App\Models\User;
use App\Mails\Invited;
use App\Events\SessionCreated;
use Illuminate\Support\Facades\Mail;

class InviteUsers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SessionCreated  $event
     * @return void
     */
    public function handle(SessionCreated $event)
    {
        $session = $event->session;

        array_walk($event->invitees, function ($invitee) use ($session) {
            $user = User::findOrFail($invitee);

            Mail::to($user->email)
                ->send(new Invited($session));
        });
    }
}
