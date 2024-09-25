<?php

namespace App\DataTransferObjects;

class UserDto
{
    public $id;
    public $name;
    public $email;
    public $about;

    public function __construct(int $id, string $name, string $email, ?string $about)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->about = $about;
    }

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
