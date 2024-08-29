<?php

namespace App\Services;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Collection;


class PostService
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getFeedPosts(int $userId): Collection
    {
        return $this->postRepository->getAllPosts()->where('author_id', '!=', $userId);
    }

    public function getPostsByAuthor(int $authorId): Collection
    {
        return $this->postRepository->getPostsByAuthor($authorId);
    }

    public function createPost(array $data, int $authorId): Post
    {
        $data['author_id'] = $authorId;
        return $this->postRepository->createPost($data);
    }

    public function getPostById(int $id): Post
    {
        return $this->postRepository->getPostById($id);
    }

    public function updatePost(array $data): Post
    {
        return $this->postRepository->updatePost($data['id'], $data);
    }

    public function deletePost(int $id): void
    {
        $this->postRepository->deletePost($id);
    }
}
