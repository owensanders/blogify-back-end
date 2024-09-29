<?php

namespace App\UseCases;

use App\DataTransferObjects\PostDto;
use App\Interfaces\PostRepositoryInterface;

readonly class CommentOnPostUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {}

    public function handle(PostDto $postDto): void
    {
        $this->postRepository->comment($postDto);
    }
}
