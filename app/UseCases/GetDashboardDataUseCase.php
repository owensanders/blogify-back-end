<?php

namespace App\UseCases;

use App\Interfaces\DashboardRepositoryInterface;

class GetDashboardDataUseCase
{
    private $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function handle(): array
    {
        $userPosts = $this->dashboardRepository->getUserPosts();
        $userMostRecentPost = $this->dashboardRepository->getUsersMostRecentPost();

        return ['posts' => $userPosts, 'mostRecentPost' => $userMostRecentPost];
    }
}
