<?php

namespace App\UseCases;

use App\DataTransferObjects\PostDto;
use App\Interfaces\PostRepositoryInterface;

class CreatePostUseCase
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(PostDto $dto): PostDto
    {
        return $this->postRepository->createPost($dto);
    }
}
