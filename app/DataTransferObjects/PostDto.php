<?php

namespace App\DataTransferObjects;
use Illuminate\Support\Collection;

class PostDto
{
    public $id;
    public $title;
    public $body;
    public $authorId;
    public $comment;
    public $likes;
    public $comments;

    public function __construct(
        ?int $id = null,
        ?string $title,
        string $body = null,
        int $authorId,
        ?string $comment = null,
        ?Collection $likes = null,
        ?Collection $comments = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->authorId = $authorId;
        $this->comment = $comment;
        $this->likes = $likes;
        $this->comments = $comments;
    }
}
