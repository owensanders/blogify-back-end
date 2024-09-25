<?php

namespace App\Interfaces;

use App\Models\Post;
use Illuminate\Support\Collection;

interface DashboardRepositoryInterface
{
    public function getUserPosts(): Collection;
    public function getUsersMostRecentPost(): ?Post;
}
