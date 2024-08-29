<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findUserById(int $id): ?User;
    public function updateUser(int $id, array $data): bool;
}
