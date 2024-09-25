<?php

namespace App\UseCases;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Collection;

class GetPostsByAuthorUseCase
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(int $id): Collection
    {
        return $this->postRepository->getPostsByAuthor($id);
    }
}
