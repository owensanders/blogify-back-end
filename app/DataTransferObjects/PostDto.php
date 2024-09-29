<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Collection;

class PostDto
{
    public function __construct(
        public ?string $title,
        public int $authorId,
        public ?int $id = null,
        public ?string $body = null,
        public ?string $comment = null,
        public ?Collection $likes = null,
        public ?Collection $comments = null
    ) {}
}
