<?php

namespace App\UseCases;

use App\Interfaces\PostRepositoryInterface;

readonly class GetDashboardDataUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {}

    public function handle(): array
    {
        $userPosts = $this->postRepository->getUserPosts();
        $userMostRecentPost = $this->postRepository->getUsersMostRecentPost();

        return ['posts' => $userPosts, 'mostRecentPost' => $userMostRecentPost];
    }
}
