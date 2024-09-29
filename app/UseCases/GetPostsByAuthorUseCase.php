<?php

namespace App\UseCases;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Collection;

readonly class GetPostsByAuthorUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {}

    public function handle(int $id): Collection
    {
        return $this->postRepository->getPostsByAuthor($id);
    }
}
