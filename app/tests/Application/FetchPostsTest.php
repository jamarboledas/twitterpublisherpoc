<?php declare(strict_types=1);

use App\Application\FetchPosts;
use PHPUnit\Framework\TestCase as KernelTestCase;
use App\Infrastructure\TwitterClient;

final class HelloWorldTest extends KernelTestCase
{
    public function testFetch(): void
    {
        $this->assertTrue(true);
        $twitterClient = new TwitterClient();
        $fetchPost = new FetchPosts($twitterClient);
        $tweets = $fetchPost->fetch('hello', 10);
        dump($tweets);
        $this->assertCount(10, $tweets);
    }
}