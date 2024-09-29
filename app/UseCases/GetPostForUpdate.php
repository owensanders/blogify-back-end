<?php

namespace App\UseCases;

use App\DataTransferObjects\PostDto;
use App\Interfaces\PostRepositoryInterface;

readonly class GetPostForUpdate
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {}

    public function handle(int $id): ?PostDto
    {
        return $this->postRepository->getPostById($id);
    }
}
