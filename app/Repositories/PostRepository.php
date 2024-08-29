<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PostRepository implements PostRepositoryInterface
{
    private function getCacheKey(int $id): string
    {
        return "posts_author_$id";
    }

    public function getAllPosts(): Collection
    {
        return Post::all();
    }

    public function getPostsByAuthor(int $authorId): Collection
    {
        $cacheKey = $this->getCacheKey($authorId);

        return Cache::remember($cacheKey, 60 * 60, function () use ($authorId) {
            return Post::where('author_id', $authorId)->get();
        });
    }

    public function getPostById(int $id): Post
    {
        return Post::findOrFail($id);
    }

    public function createPost(array $data): Post
    {
        $post = Post::create($data);
        Cache::forget($this->getCacheKey($data['author_id']));
        return $post;
    }

    public function updatePost(int $id, array $data): Post
    {
        $post = Post::findOrFail($id);
        $post->update($data);
        Cache::forget($this->getCacheKey($post->author_id));
        return $post;
    }

    public function deletePost(int $id): void
    {
        $post = Post::findOrFail($id);
        $post->delete();
        Cache::forget($this->getCacheKey($post->author_id));
    }
}
