<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function comment(int $postId, string $comment): void;
}
