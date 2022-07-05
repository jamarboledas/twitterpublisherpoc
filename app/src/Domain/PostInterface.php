<?php

namespace App\Domain;

interface PostInterface
{
    /**
     * @param string $status
     * @return bool
     */
    public function post(string $status) : bool;
}
