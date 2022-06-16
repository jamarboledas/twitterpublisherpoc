<?php declare(strict_types=1);

use App\Application\FetchPosts;
use PHPUnit\Framework\TestCase as KernelTestCase;
use App\Infrastructure\TwitterClient;

final class HelloWorldTest extends KernelTestCase
{
    public function testFetchTenPostsWorksProperly(): void
    {
        $twitterClient = new TwitterClient();
        $fetchPost = new FetchPosts($twitterClient);
        $tweets = $fetchPost->fetch('hello', 10);
        $this->assertCount(10, $tweets);
    }
}