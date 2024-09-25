<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;
use App\DataTransferObjects\PostDto;

interface DashboardRepositoryInterface
{
    public function getUserPosts(): Collection;
    public function getUsersMostRecentPost(): ?PostDto;
}
