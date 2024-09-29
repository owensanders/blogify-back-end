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
            $post->title,
            $post->author_id,
            $post->id,
            $post->body,
            null,
            $post->likes,
            $post->comments
        );
    }

    public static function fromRequest(Request $request): PostDto
    {
        return new PostDto(
            $request->input('title'),
            auth()->user()->id,
            $request->input('id'),
            $request->input('body'),
            $request->input('comment'),
            null,
            null
        );
    }
}

