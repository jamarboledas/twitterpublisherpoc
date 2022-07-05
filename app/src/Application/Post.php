<?php

namespace App\Application;

use App\Domain\PostInterface;

class Post
{
    private PostInterface $postClient;

    public function __construct(PostInterface $postClient)
    {
        $this->postClient = $postClient;
    }

    /**
     * @param string $status
     * @return bool
     */
    public function post(string $status) 
    {
        return $this->postClient->post($status);
    }
}
