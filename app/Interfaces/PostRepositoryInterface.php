<?php

namespace App\Interfaces;

use App\DataTransferObjects\PostDto;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    public function getAllPosts(): Collection;
    public function getPostsByAuthor(int $authorId): Collection;
    public function getPostById(int $id): ?PostDto;
    public function createPost(PostDto $dto): PostDto;
    public function updatePost(PostDto $dto): PostDto;
    public function deletePost(int $id): void;
    public function likePost(int $id): void;
    public function comment(PostDto $postDto): void;
    public function getUserPosts(): Collection;
    public function getUsersMostRecentPost(): ?PostDto;
}
