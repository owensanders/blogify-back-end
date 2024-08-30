<?php

namespace App\Interfaces;

interface LikeRepositoryInterface
{
    public function likePost(int $postId): void;
}
