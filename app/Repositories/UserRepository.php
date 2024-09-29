<?php

namespace App\Repositories;

use App\DataTransferObjects\UserDto;
use App\DtoFactories\UserDtoFactory;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

readonly class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $model)
    {}

    public function findUserById(int $id): ?UserDto
    {
        $user = $this->model::find($id);

        return $user ? UserDtoFactory::fromModel($user) : null;
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
