<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

readonly class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(private Comment $model)
    {}

    public function comment(int $postId, string $comment): void
    {
        $this->model::create([
            'user_id' => auth()->user()->id,
            'post_id' => $postId,
            'comment' => $comment,
        ]);
    }
}
