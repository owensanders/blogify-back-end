<?php

namespace App\UseCases;

use App\DataTransferObjects\PostDto;
use App\Interfaces\PostRepositoryInterface;

class GetPostForUpdate
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(int $id): ?PostDto
    {
        return $this->postRepository->getPostById($id);
    }
}
