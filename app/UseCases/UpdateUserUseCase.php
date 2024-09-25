<?php

namespace App\UseCases;

use App\DataTransferObjects\UserDto;
use App\Interfaces\UserRepositoryInterface;

class UpdateUserUseCase
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UserDto $userDto): ?UserDto
    {
        $this->userRepository->updateUser($userDto);

        return $this->userRepository->findUserById($userDto->id);
    }
}
