<?php

namespace App\Application;
use App\Domain\FetchInterface;

class FetchPosts
{
    private FetchInterface $fetchClient;

    public function __construct(FetchInterface $fetchClient)
    {
        $this->fetchClient = $fetchClient;
    }

    /**
     * @param string $filter
     * @param int $count
     */
    public function fetch(string $filter, int $count) 
    {
        return $this->fetchClient->fetch($filter, $count);
    }
}
