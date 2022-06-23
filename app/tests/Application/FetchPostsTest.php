<?php declare(strict_types=1);

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Application\FetchPosts;
use App\Infrastructure\TwitterClient;
use PHPUnit\Framework\TestCase as KernelTestCase;

final class FetchPostsTest extends KernelTestCase
{
    public function testFetchTenPostsReturnAnArrayOfMaximunTenPosts(): void
    {
        $twitterOauth = new TwitterOAuth(
            getenv('CONSUMER_KEY'), 
            getenv('CONSUMER_SECRET'),
            getenv('ACCESS_TOKEN'),
            getenv('ACCESS_TOKEN_SECRET')
        );

        $fetchInterface = new TwitterClient($twitterOauth);
        $fetchPost = new FetchPosts($fetchInterface);
        $tweets = $fetchPost->fetch('hello', 10);
        $this->assertLessThanOrEqual(10, count($tweets));
    }
}