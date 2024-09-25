<?php

namespace App\DtoFactories;

use App\DataTransferObjects\UserDto;
use App\Models\User;
use Illuminate\Http\Request;

class UserDtoFactory
{
    public static function fromRequest(Request $request): UserDto
    {
        return new UserDto(
            auth()->user()->id,
            $request->input('name'),
            $request->input('email'),
            $request->input('about')
        );
    }

    public static function fromModel(User $user): UserDto
    {
        return new UserDto(
            $user->id,
            $user->name,
            $user->email,
            $user->about
        );
    }
}
