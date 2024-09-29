<?php

namespace App\Repositories;

use App\Interfaces\LikeRepositoryInterface;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

readonly class LikeRepository implements LikeRepositoryInterface
{
    public function __construct(private Like $model)
    {}

    public function likePost(int $postId): void
    {
        $this->model::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
        ]);
    }
}
