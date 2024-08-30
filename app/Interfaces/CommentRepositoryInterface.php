<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function comment(int $postId, array $data): void;
}
