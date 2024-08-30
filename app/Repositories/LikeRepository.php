<?php

namespace App\Repositories;

use App\Interfaces\LikeRepositoryInterface;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeRepository implements LikeRepositoryInterface
{
    public function likePost(int $postId): void
    {
        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
        ]);
    }
}
