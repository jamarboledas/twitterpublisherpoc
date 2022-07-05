<?php

namespace App\Infrastructure;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Domain\FetchInterface;
use App\Domain\PostInterface;

class TwitterClient implements FetchInterface, PostInterface
{
    private $connection;

    public function __construct(TwitterOAuth $twitterOAuth) 
    {
        $this->connection = $twitterOAuth;
    }

    /**
     * @param string $text
     * @param int $count
     * @return array|bool|object
     */
    public function fetch(string $text, int $count)
    {
        $tweets = $this->connection->get("search/tweets", ["q" => $text, "count" => $count]);        
     
        if ($this->errorHandling() === false) {
            return false;
        }

        return $tweets;
    }

    /**
     * @param string $text
     * @return bool
     */
    public function post(string $text) : bool
    {
        $this->connection->post("statuses/update", ["status" => $text]);
        return $this->errorHandling();
    }


    /**
     * @return bool
     */
    private function errorHandling() : bool
    {
        if ($this->connection->getLastHttpCode() === 200) {
            return true;
        } else {
            return false;
        }
    }
}
