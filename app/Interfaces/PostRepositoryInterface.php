<?php

namespace App\Interfaces;

use App\Models\Post;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    public function getAllPosts(): Collection;
    public function getPostsByAuthor(int $authorId): Collection;
    public function getPostById(int $id): Post;
    public function createPost(array $data): Post;
    public function updatePost(int $id, array $data): Post;
    public function deletePost(int $id): void;
    public function likePost(int $id): void;
}
