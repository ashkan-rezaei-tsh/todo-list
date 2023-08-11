<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::query()->where('email', $request->email)->firstOrFail();
            $token = $request->user()->createToken($user->name);

            return response()->json(['token' => $token->plainTextToken]);
        }

        abort(401);
    }

    public function logout(): JsonResponse
    {
        $result = auth()->user()->currentAccessToken()->delete();

        return response()->json(['status' => $result]);
    }
}
