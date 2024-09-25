<?php

namespace App\UseCases;

use App\DataTransferObjects\PostDto;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Collection;

class GetFeedPostsUseCase
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(): Collection
    {
        return $this->postRepository->getAllPosts()->filter(function (PostDto $post) {
            return $post->authorId !== auth()->user()->id;
        });
    }
}
