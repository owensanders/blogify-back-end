<?php

namespace App\Presenters;

use App\DataTransferObjects\PostDto;
use Illuminate\Support\Collection;

class DashboardPresenter
{
    public function presentUserPosts(Collection $posts, ?PostDto $mostRecentPost): array
    {
        $totalLikes = $posts->sum(function (PostDto $post) {
            return $post->likes->count();
        });

        $totalComments = $posts->sum(function (PostDto $post) {
            return $post->comments->count();
        });

        $postWithMostLikes = $posts
            ->filter(fn(PostDto $post) => $post->likes->count() > 0)
            ->sortByDesc(fn(PostDto $post) => $post->likes->count())
            ->first();

        return [
            'total_posts' => $posts->count(),
            'total_likes' => $totalLikes,
            'total_comments' => $totalComments,
            'post_with_most_likes' => $postWithMostLikes,
            'most_recent_post' => $mostRecentPost,
        ];
    }
}

