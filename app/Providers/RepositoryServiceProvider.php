<?php

namespace App\Providers;

use App\Interfaces\LikeRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\LikeRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PostRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
    }
}
