<?php

namespace App\Repositories;

use App\DataTransferObjects\PostDto;
use App\DtoFactories\PostDtoFactory;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\LikeRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PostRepository implements PostRepositoryInterface
{
    private $likeRepository;
    private $commentRepository;
    private $model;

    public function __construct(
        LikeRepositoryInterface $likeRepository,
        CommentRepositoryInterface $commentRepository,
        Post $model
    ) {
        $this->likeRepository = $likeRepository;
        $this->commentRepository = $commentRepository;
        $this->model = $model;
    }

    private function getCacheKey(int $id): string
    {
        return "posts_author_$id";
    }

    public function getAllPosts(): Collection
    {
        $posts = $this->model::with(['likes', 'comments'])->get();

        return $posts->map(function (Post $post) {
            return PostDtoFactory::fromModel($post);
        });
    }

    public function getPostsByAuthor(int $id): Collection
    {
        $cacheKey = $this->getCacheKey($id);

        $posts = Cache::remember($cacheKey, 60 * 60, function () use ($id) {
            return $this->model::where('author_id', $id)
                ->with(['likes', 'comments'])
                ->get();
        });

        return $posts->map(function (Post $post) {
            return PostDtoFactory::fromModel($post);
        });
    }

    public function getPostById(int $id): ?PostDto
    {
        $post = $this->model::find($id);
        return $post ? PostDtoFactory::fromModel($post) : null;
    }

    public function getUserPosts(): Collection
    {
        $posts = $this->model::where('author_id', auth()->user()->id)
            ->with(['likes', 'comments'])
            ->get();

        return $posts->map(function (Post $post) {
            return PostDtoFactory::fromModel($post);
        });
    }

    public function getUsersMostRecentPost(): ?PostDto
    {
        $post = $this->model::where('author_id', auth()->user()->id)
            ->latest()
            ->first();

        return $post ? PostDtoFactory::fromModel($post) : null;
    }

    public function createPost(PostDto $dto): PostDto
    {
        $post = $this->model::create([
            'title' => $dto->title,
            'body' => $dto->body,
            'author_id' => $dto->authorId,
        ]);

        Cache::forget($this->getCacheKey($dto->authorId));

        return PostDtoFactory::fromModel($post);
    }

    public function updatePost(PostDto $dto): PostDto
    {
        $post = $this->model::findOrFail($dto->id);
        $post->update([
            'title' => $dto->title,
            'body' => $dto->body
        ]);

        Cache::forget($this->getCacheKey($dto->authorId));

        return PostDtoFactory::fromModel($post);
    }

    public function deletePost(int $id): void
    {
        $post = $this->model::findOrFail($id);
        $post->delete();

        Cache::forget($this->getCacheKey($post->author_id));
    }

    public function likePost(int $id): void
    {
        $post = $this->model::findOrFail($id);
        $this->likeRepository->likePost($post->id);

        Cache::forget($this->getCacheKey($post->author_id));
    }

    public function comment(int $id, array $data): void
    {
        $post = $this->model::findOrFail($id);
        $this->commentRepository->comment($post->id, $data);

        Cache::forget($this->getCacheKey($post->author_id));
    }
}
