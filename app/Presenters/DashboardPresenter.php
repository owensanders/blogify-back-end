<?php

namespace App\Presenters;

use App\DataTransferObjects\PostDto;
use Illuminate\Support\Collection;

class DashboardPresenter
{
    public function presentUserPosts(Collection $posts, ?PostDto $mostRecentPost): array
    {
        $totalLikes = $posts->sum(function (PostDto $post) {
            return $post->totalLikes;
        });

        $totalComments = $posts->sum(function (PostDto $post) {
            return $post->totalComments;
        });

        $postWithMostLikes = $posts->filter(function (PostDto $post) {
            return $post->totalLikes > 0;
        })->sortByDesc(function (PostDto $post) {
            return $post->totalLikes;
        })->first();

        return [
            'total_posts' => $posts->count(),
            'total_likes' => $totalLikes,
            'total_comments' => $totalComments,
            'post_with_most_likes' => $postWithMostLikes,
            'most_recent_post' => $mostRecentPost,
        ];
    }
}

