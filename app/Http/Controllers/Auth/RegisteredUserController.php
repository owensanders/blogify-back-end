<?php

namespace App\Http\Controllers\Auth;

use App\DtoFactories\UserDtoFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\UseCases\CreateUserUseCase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function __construct(
        private readonly CreateUserUseCase $createUserUseCase,
        private readonly UserDtoFactory $userDtoFactory
    )
    {}

    public function store(RegisterRequest $request): JsonResponse
    {
        $dto = $this->userDtoFactory::fromRequest($request);
        $user = $this->createUserUseCase->handle($dto);

        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => Auth::user(),
        ]);
    }
}
