<?php

namespace App\Repositories;

use App\Models\Session;
use App\Interfaces\SessionInterface;

class SessionRepository implements SessionInterface {

    /**
     * Store the session in storage
     *
     * @param array $params
     * @param string $userId
     *
     * @return Session
     */
    public function create(array $params, string $userId)
    {
        $session = Session::create([
            'user_id' => $userId,
            'name' => $params['name'],
        ]);

        $session->invitees()->attach($userId, ['is_moderator' => true]);

        array_walk($params['invitees'], function ($inviteeId) use ($session, $userId) {
            if ($inviteeId != $userId) $session->invitees()->attach($inviteeId);
        });

        return $session;
    }

    /**
     * Return all stored sessions
     *
     */
    public function all()
    {
        return Session::with('invitees')->get();
    }

    /**
     * Remove the session from storage
     *
     * @param string $id
     */
    public function destroy(string $id)
    {
        $session = Session::findOrFail($id);

        $session->invitees()->detach();

        $session->delete();
    }
}
