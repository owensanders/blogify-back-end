<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'string|required',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(auth()->user()->id),
            ],
            'about' => 'max:255'
        ]);

        User::where('id', auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'about' => $request->about
        ]);

        return response()->json(['message' => 'Profile updated successfully', 'user' => Auth::user()]);
    }
}

