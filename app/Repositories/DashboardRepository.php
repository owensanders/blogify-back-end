<?php

namespace App\Repositories;

use App\DataTransferObjects\PostDto;
use App\DtoFactories\PostDtoFactory;
use App\Interfaces\DashboardRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Collection;

class DashboardRepository implements DashboardRepositoryInterface
{
    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getUserPosts(): Collection
    {
        $posts = $this->model::where('author_id', auth()->user()->id)
            ->with(['likes', 'comments'])
            ->get();

        return $posts->map(function (Post $post) {
            return PostDtoFactory::fromModel($post);
        });
    }

    public function getUsersMostRecentPost(): ?PostDto
    {
        $post = $this->model::where('author_id', auth()->user()->id)
            ->latest()
            ->first();

        return $post ? PostDtoFactory::fromModel($post) : null;
    }
}
