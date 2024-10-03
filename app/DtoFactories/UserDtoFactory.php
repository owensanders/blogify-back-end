<?php

namespace App\DtoFactories;

use App\DataTransferObjects\UserDto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDtoFactory
{
    public static function fromRequest(Request $request): UserDto
    {
        return new UserDto(
            auth()->check() ? auth()->user()->id : null,
            $request->input('name'),
            $request->input('email'),
            $request->input('password') ? Hash::make($request->input('password')) : null,
            $request->input('about')
        );
    }

    public static function fromModel(User $user): UserDto
    {
        return new UserDto(
            $user->id,
            $user->name,
            $user->email,
            null,
            $user->about
        );
    }
}
