<?php

namespace App\Interfaces;

use App\DTO\UserDto;
use App\Models\User;

interface UserRepositoryInterface
{
    public function findUserById(int $id): ?User;
    public function updateUser(UserDto $userDto): bool;
}
