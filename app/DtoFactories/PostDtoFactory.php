<?php

namespace App\DtoFactories;

use App\DataTransferObjects\PostDto;
use App\Models\Post;
use Illuminate\Http\Request;

class PostDtoFactory
{
    public static function fromModel(Post $post): PostDto
    {
        return new PostDto(
            $post->id,
            $post->title,
            $post->body,
            $post->author_id,
            $post->likes->count(),
            $post->comments->count()
        );
    }

    public static function fromRequest(Request $request): PostDto
    {
        return new PostDto(
            id: $request->input('id'),
            title: $request->input('title'),
            body: $request->input('body'),
            authorId: auth()->user()->id,
        );
    }
}
