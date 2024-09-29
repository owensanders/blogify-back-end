<?php

namespace App\UseCases;

use App\Interfaces\PostRepositoryInterface;

readonly class DeletePostUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {}

    public function handle(int $id): void
    {
        $this->postRepository->deletePost($id);
    }
}
