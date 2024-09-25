<?php

namespace App\UseCases;

use App\DTO\UserDto;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UpdateUserUseCase
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UserDto $userDto): User
    {
        $this->userRepository->updateUser($userDto);

        return $this->userRepository->findUserById($userDto->id);
    }
}
