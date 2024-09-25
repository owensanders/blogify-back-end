<?php

namespace App\DtoFactories;

use App\DTO\UserDto;
use Illuminate\Http\Request;

class UserDtoFactory
{
    public function fromRequest(Request $request): UserDto
    {
        return new UserDto(
            auth()->user()->id,
            $request->input('name'),
            $request->input('email'),
            $request->input('about')
        );
    }
}
