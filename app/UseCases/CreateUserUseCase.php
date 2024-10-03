<?php

namespace App\UseCases;

use App\DataTransferObjects\UserDto;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class CreateUserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    public function handle(UserDto $userDto): User
    {
        return $this->userRepository->store($userDto);
    }
}
