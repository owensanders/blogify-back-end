<?php

namespace App\Services;

use App\Interfaces\DashboardRepositoryInterface;

class DashboardService
{
    private $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function fetchDashboardData(): array
    {
        return $this->dashboardRepository->get();
    }
}
