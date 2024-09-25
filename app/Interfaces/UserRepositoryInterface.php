<?php

namespace App\Interfaces;

use App\DataTransferObjects\UserDto;

interface UserRepositoryInterface
{
    public function findUserById(int $id): ?UserDto;
    public function updateUser(UserDto $userDto): bool;
}
