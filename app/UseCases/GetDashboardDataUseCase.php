<?php

namespace App\UseCases;

use App\Interfaces\PostRepositoryInterface;

class GetDashboardDataUseCase
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(): array
    {
        $userPosts = $this->postRepository->getUserPosts();
        $userMostRecentPost = $this->postRepository->getUsersMostRecentPost();

        return ['posts' => $userPosts, 'mostRecentPost' => $userMostRecentPost];
    }
}
