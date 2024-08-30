<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{
    public function comment(int $postId, array $data): void
    {
        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'comment' => $data['comment'],
        ]);
    }
}
