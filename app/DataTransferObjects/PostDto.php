<?php

namespace App\DataTransferObjects;

class PostDto
{
    public $id;
    public $title;
    public $body;
    public $authorId;
    public $totalLikes;
    public $totalComments;

    public function __construct(
        ?int $id = null,
        string $title,
        string $body,
        int $authorId,
        ?int $totalLikes = null,
        ?int $totalComments = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->authorId = $authorId;
        $this->totalLikes = $totalLikes;
        $this->totalComments = $totalComments;
    }
}
