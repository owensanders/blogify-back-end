<?php

namespace App\UseCases;

use App\DataTransferObjects\PostDto;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Collection;

readonly class GetFeedPostsUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {}

    public function handle(): Collection
    {
        return $this->postRepository->getAllPosts()
            ->filter(fn(PostDto $post) => $post->authorId !== auth()->user()->id);
    }
}
