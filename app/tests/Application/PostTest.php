<?php declare(strict_types=1);

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Application\Post;
use App\Domain\PostInterface;
use App\Infrastructure\TwitterClient;
use PHPUnit\Framework\TestCase as KernelTestCase;

final class PostTest extends KernelTestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testPostCanPublic($status): void
    {
        $twitterOauth = new TwitterOAuth(
            getenv('CONSUMER_KEY'), 
            getenv('CONSUMER_SECRET'),
            getenv('ACCESS_TOKEN'),
            getenv('ACCESS_TOKEN_SECRET')
        );

        $postInterface = new TwitterClient($twitterOauth);
        $postClient = new Post($postInterface);
        $published = $postClient->post($status);
        $this->assertTrue($published);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testPostCanNotPublish($status): void
    {
        $postInterface = $this->createMock(PostInterface::class);

        $postClient = new Post($postInterface);
        $published = $postClient->post($status);
        $this->assertFalse($published);
    }

    public function dataProvider()
    {
        return array(
          array(uniqid())
        );
    }
}