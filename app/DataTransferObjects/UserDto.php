<?php

namespace App\DataTransferObjects;

class UserDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public ?string $about
    )
    {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'about' => $this->about,
        ];
    }
}
