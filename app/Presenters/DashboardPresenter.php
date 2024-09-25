<?php

namespace App\Presenters;

use App\Models\Post;
use Illuminate\Support\Collection;

class DashboardPresenter
{
    public function presentUserPosts(Collection $posts, ?Post $post): array
    {
        $totalLikes = $posts->sum(function ($post) {
            return $post->likes->count();
        });

        $totalComments = $posts->sum(function ($post) {
            return $post->comments->count();
        });

        $postWithMostLikes = $posts->filter(function ($post) {
            return $post->likes->count() > 0;
        })->sortByDesc(function ($post) {
            return $post->likes->count();
        })->first();

        return [
            'total_posts' => $posts->count(),
            'total_likes' => $totalLikes,
            'total_comments' => $totalComments,
            'post_with_most_likes' => $postWithMostLikes,
            'most_recent_post' => $post,
        ];
    }
}
