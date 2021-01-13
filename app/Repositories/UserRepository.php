<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;

class UserRepository implements UserInterface {

    /**
     * Get the user
     *
     * @param string $id
     * @return User
     */
    public function me(string $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Get all users
     *
     * @return User[]
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Get the user's sessions
     *
     * @param string $id
     * @return mixed
     */
    public function sessions(string $id)
    {
        return User::findOrFail(auth()->user()->id)->sessions;
    }
}
