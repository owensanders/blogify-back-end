<?php

namespace App\UseCases;

use App\Interfaces\PostRepositoryInterface;

class DeletePostUseCase
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(int $id): void
    {
        $this->postRepository->deletePost($id);
    }
}
