<?php declare(strict_types=1);

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Application\Fetch;
use App\Infrastructure\TwitterClient;
use PHPUnit\Framework\TestCase as KernelTestCase;

final class FetchTest extends KernelTestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testFetchTenPostsReturnAnArrayOfMaximunTenPosts($filter, $maxElements): void
    {
        $twitterOauth = new TwitterOAuth(
            getenv('CONSUMER_KEY'), 
            getenv('CONSUMER_SECRET'),
            getenv('ACCESS_TOKEN'),
            getenv('ACCESS_TOKEN_SECRET')
        );

        $fetchInterface = new TwitterClient($twitterOauth);
        $fetchPost = new Fetch($fetchInterface);
        $tweets = $fetchPost->fetch($filter, $maxElements);
        $this->assertLessThanOrEqual($maxElements, count($tweets));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFetchPostsWithZeroAsMaxElementsReturnsFifteenElementsOrLess($filter): void
    {
        $twitterOauth = new TwitterOAuth(
            getenv('CONSUMER_KEY'), 
            getenv('CONSUMER_SECRET'),
            getenv('ACCESS_TOKEN'),
            getenv('ACCESS_TOKEN_SECRET')
        );

        $fetchInterface = new TwitterClient($twitterOauth);
        $fetchPost = new Fetch($fetchInterface);
        $tweets = $fetchPost->fetch($filter, 0);
        $this->assertLessThanOrEqual(15, count($tweets));
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testFetchPostsWithInvalidArgumentAsMaxElementsReturnsFalse($filter, $maxElements): void
    {
        $twitterOauth = new TwitterOAuth(
            getenv('CONSUMER_KEY'), 
            getenv('CONSUMER_SECRET'),
            getenv('ACCESS_TOKEN'),
            getenv('ACCESS_TOKEN_SECRET')
        );

        $fetchInterface = new TwitterClient($twitterOauth);
        $fetchPost = new Fetch($fetchInterface);
        $tweets = $fetchPost->fetch($filter, $maxElements);
        $this->assertFalse($tweets);
    }

    public function dataProvider()
    {
        return array(
          array('hello', 5),
          array('this', 10),
          array('is', 20),
          array('a', 30),
          array('test', 40)
        );
    }

    public function invalidDataProvider()
    {
        return array(
          array('less than zero', -5)
        );
    }
}