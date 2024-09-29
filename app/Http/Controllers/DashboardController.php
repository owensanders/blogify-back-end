<?php

namespace App\Http\Controllers;

use App\Presenters\DashboardPresenter;
use App\UseCases\GetDashboardDataUseCase;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __construct(
        private readonly GetDashboardDataUseCase $getDashboardDataUseCase,
        private readonly DashboardPresenter $dashboardPresenter
    ) {}

    public function index(): JsonResponse
    {
        $posts = $this->getDashboardDataUseCase->handle();
        $data = $this->dashboardPresenter->presentUserPosts($posts['posts'], $posts['mostRecentPost']);

        return response()->json($data);
    }
}
