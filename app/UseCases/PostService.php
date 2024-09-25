<?php

namespace App\UseCases;

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

    public function deletePost(int $id): void
    {
        $this->postRepository->deletePost($id);
    }

    public function likePost(int $id): void
    {
        $this->postRepository->likePost($id);
    }

    public function commentOnPost(array $data): void
    {
        $this->postRepository->comment($data['id'], $data);
    }
}
