<?php

namespace App\Interfaces;

interface SessionInterface {

    /**
     * @param array $params
     * @param string $userId
     * @return mixed
     */
    public function create(array $params, string $userId);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @param string $id
     * @return mixed
     */
    public function destroy(string $id);
}
