<?php

namespace App\Http\Controllers;

use App\DtoFactories\UserDtoFactory;
use App\Http\Requests\UpdateUserRequest;
use App\UseCases\UpdateUserUseCase;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private readonly UpdateUserUseCase $updateUserUseCase)
    {}

    public function update(UpdateUserRequest $request): JsonResponse
    {
        $dto = UserDtoFactory::fromRequest($request);
        $user = $this->updateUserUseCase->handle($dto);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user->toArray(),
        ]);
    }
}
