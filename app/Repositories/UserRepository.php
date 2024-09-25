<?php

namespace App\Repositories;

use App\DTO\UserDto;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function findUserById(int $id): ?User
    {
        return $this->model::find($id);
    }

    public function updateUser(UserDto $userDto): bool
    {
        return $this->model::where('id', $userDto->id)->update([
            'name' => $userDto->name,
            'email' => $userDto->email,
            'about' => $userDto->about ?? null,
        ]);
    }
}
