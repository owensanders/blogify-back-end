<?php

namespace App\UseCases;

use App\DataTransferObjects\UserDto;
use App\Interfaces\UserRepositoryInterface;

readonly class UpdateUserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    public function handle(UserDto $userDto): ?UserDto
    {
        $this->userRepository->updateUser($userDto);

        return $this->userRepository->findUserById($userDto->id);
    }
}
