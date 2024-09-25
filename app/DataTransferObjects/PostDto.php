<?php

namespace App\DataTransferObjects;

class PostDto
{
    public $id;
    public $title;
    public $authorId;
    public $totalLikes;
    public $totalComments;

    public function __construct(int $id, string $title, int $authorId, int $totalLikes, int $totalComments)
    {
        $this->id = $id;
        $this->title = $title;
        $this->authorId = $authorId;
        $this->totalLikes = $totalLikes;
        $this->totalComments = $totalComments;
    }
}
