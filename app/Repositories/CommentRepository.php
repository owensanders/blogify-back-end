<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{
    public function comment(int $postId, string $comment): void
    {
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $postId,
            'comment' => $comment,
        ]);
    }
}
