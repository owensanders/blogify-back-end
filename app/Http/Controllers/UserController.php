<?php

namespace App\Http\Controllers;

use App\DtoFactories\UserDtoFactory;
use App\Http\Requests\UpdateUserRequest;
use App\UseCases\UpdateUserUseCase;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $updateUserUseCase;
    private $userDtoFactory;

    public function __construct(UpdateUserUseCase $updateUserUseCase, UserDtoFactory $userDtoFactory)
    {
        $this->updateUserUseCase = $updateUserUseCase;
        $this->userDtoFactory = $userDtoFactory;
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        $dto = $this->userDtoFactory->fromRequest($request);
        $user = $this->updateUserUseCase->handle($dto);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
        ]);
    }
}
