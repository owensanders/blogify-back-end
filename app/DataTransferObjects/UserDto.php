<?php

namespace App\DTO;

class UserDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public ?string $about
    ) {
    }
}
