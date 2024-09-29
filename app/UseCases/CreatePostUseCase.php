<?php

namespace App\UseCases;

use App\DataTransferObjects\PostDto;
use App\Interfaces\PostRepositoryInterface;

readonly class CreatePostUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {}

    public function handle(PostDto $dto): PostDto
    {
        return $this->postRepository->createPost($dto);
    }
}
