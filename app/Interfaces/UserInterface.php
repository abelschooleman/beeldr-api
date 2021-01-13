<?php

namespace App\Interfaces;

interface UserInterface {

    /**
     * @param string $id
     * @return mixed
     */
    public function me(string $id);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @param string $id
     * @return mixed
     */
    public function sessions(string $id);
}
