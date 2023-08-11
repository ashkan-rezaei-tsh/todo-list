<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::query()->where('email', $request->email)->firstOrFail();
            $token = $request->user()->createToken($user->name);

            return response(['token' => $token->plainTextToken]);
        }

        return response(['status' => false], 401);
    }
}
