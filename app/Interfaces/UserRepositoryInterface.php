<?php

namespace App\Interfaces;

use App\DataTransferObjects\UserDto;
use App\Models\User;

interface UserRepositoryInterface
{
    public function findUserById(int $id): ?UserDto;
    public function updateUser(UserDto $userDto): bool;
    public function store(UserDto $userDto): User;
}
