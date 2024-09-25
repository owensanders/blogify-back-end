<?php

namespace App\DtoFactories;

use App\DataTransferObjects\PostDto;
use App\Models\Post;

class PostDtoFactory
{
    public static function fromModel(Post $post): PostDto
    {
        return new PostDto(
            $post->id,
            $post->title,
            $post->author_id,
            $post->likes->count(),
            $post->comments->count()
        );
    }
}
