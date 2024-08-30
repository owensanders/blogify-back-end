<?php

namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function get(): array
    {
        $posts = Post::where('author_id', Auth::id())->with(['likes', 'comments'])->get();

        $totalLikes = $posts->sum(function ($post) {
            return $post->likes->count();
        });

        $totalComments = $posts->sum(function ($post) {
            return $post->comments->count();
        });

        $mostRecentPost = Post::where('author_id', Auth::id())->latest()->first();
        $postWithMostLikes = $posts->filter(function ($post) {
            return $post->likes->count() > 0;
        })->sortByDesc(function ($post) {
            return $post->likes->count();
        })->first();

        return [
            'total_posts' => $posts->count(),
            'total_likes' => $totalLikes,
            'total_comments' => $totalComments,
            'most_recent_post' => $mostRecentPost,
            'post_with_most_likes' => $postWithMostLikes,
        ];
    }
}
