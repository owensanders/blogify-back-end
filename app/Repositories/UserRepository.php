<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function findUserById(int $id): ?User
    {
        return User::find($id);
    }

    public function updateUser(int $id, array $data): bool
    {
        return User::where('id', $id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'about' => $data['about'] ?? null,
        ]);
    }
}
