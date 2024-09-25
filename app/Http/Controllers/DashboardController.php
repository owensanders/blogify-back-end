<?php

namespace App\Http\Controllers;

use App\Presenters\DashboardPresenter;
use App\UseCases\GetDashboardDataUseCase;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    private $getDashboardDataUseCase;
    private $dashboardPresenter;

    public function __construct(
        GetDashboardDataUseCase $getDashboardDataUseCase,
        DashboardPresenter $dashboardPresenter
    ) {
        $this->getDashboardDataUseCase = $getDashboardDataUseCase;
        $this->dashboardPresenter = $dashboardPresenter;
    }

    public function index(): JsonResponse
    {
        $posts = $this->getDashboardDataUseCase->handle();
        $data = $this->dashboardPresenter->presentUserPosts($posts['posts'], $posts['mostRecentPost']);

        return response()->json($data);
    }
}
