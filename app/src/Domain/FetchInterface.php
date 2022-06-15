<?php

namespace App\Domain;

interface FetchInterface
{
    /**
     * @param string $filter
     * @param int $count
     */
    public function fetch(string $filter, int $count);
}
