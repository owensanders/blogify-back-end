<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateUser(int $userId, array $data): User
    {
        $this->userRepository->updateUser($userId, $data);

        return $this->userRepository->findUserById($userId);
    }
}
