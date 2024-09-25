<?php

namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DashboardRepository implements DashboardRepositoryInterface
{
    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }
    public function getUserPosts(): Collection
    {
        return $this->model::where('author_id', auth()->user()->id)
            ->with(['likes', 'comments'])
            ->get();
    }

    public function getUsersMostRecentPost(): ?Post
    {
        return $this->model::where('author_id', auth()->user()->id)
            ->latest()
            ->first();
    }
}
