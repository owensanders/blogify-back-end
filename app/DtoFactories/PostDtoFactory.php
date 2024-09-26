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
            null,
            $post->likes,
            $post->comments
        );
    }

    public static function fromRequest(Request $request): PostDto
    {
        return new PostDto(
            $request->input('id'),
            $request->input('title'),
            $request->input('body'),
            auth()->user()->id,
            $request->input('comment'),
            null,
            null
        );
    }
}
