<?php

namespace App\Application;
use App\Domain\FetchInterface;
use App\Domain\PostDTO;

class Fetch
{
    private FetchInterface $fetchClient;

    public function __construct(FetchInterface $fetchClient)
    {
        $this->fetchClient = $fetchClient;
    }

    /**
     * @param string $filter
     * @param int $count
     * @return array|bool
     */
    public function fetch(string $filter, int $count) 
    {
        $posts = $this->fetchClient->fetch($filter, $count);

        if ($posts === false) {
            return false;
        }

        return $this->transform($posts);
    }

    /**
     * @param object $posts
     * @return array
     */
    private function transform(object $posts) : array
    {
        $formattedPosts = [];
        $formattedPosts = array_map(function($post) {
            $transformed = new PostDTO();
            $transformed->id = $post->id_str;
            $transformed->text = $post->text;
            $transformed->user = $post->user->screen_name;
            $transformed->created_at = $post->created_at;
            return $transformed;
        }, $posts->statuses);

        return $formattedPosts;
    }
}
