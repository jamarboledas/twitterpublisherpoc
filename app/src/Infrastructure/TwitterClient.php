<?php

namespace App\Infrastructure;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Domain\FetchInterface;

class TwitterClient implements FetchInterface
{
    private $connection;

    public function __construct() 
    {
        $this->connection = new TwitterOAuth(
            getenv('CONSUMER_KEY'), 
            getenv('CONSUMER_SECRET'),
            getenv('ACCESS_TOKEN'),
            getenv('ACCESS_TOKEN_SECRET')
        );
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
