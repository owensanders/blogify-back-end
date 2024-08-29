<?php

namespace App\Providers;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PostRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }
}
