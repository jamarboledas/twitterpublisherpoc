<?php

namespace App\Application;
use App\Domain\FetchInterface;
use App\Domain\PostDTO;
use stdClass;

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
        $posts = $this->fetchClient->fetch($filter, $count);
        return $this->transform($posts);
    }

    private function transform(stdClass $posts) 
    {
        $formattedPosts = [];
        
        foreach ($posts->statuses as $post) {
            $transformed = new PostDTO();
            $transformed->id = $post->id_str;
            $transformed->text = $post->text;
            $transformed->user = $post->user->screen_name;
            $transformed->created_at = $post->created_at;
            $formattedPosts[] = $transformed;
        }

        return $formattedPosts;
    }
}
