<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            $userExists = User::where('email', $credentials['email'])->exists();

            if ($userExists) {
                return response(['message' => 'Incorrect password.'], Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                return response(['message' => 'Username does not exist.'], Response::HTTP_NOT_FOUND);
            }
        }

        $user = Auth::user();

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response(['error' => 'Could not create token'], 500);
        }

        $tokenType = 'Bearer';
        $expiresIn = JWTAuth::factory()->getTTL() * 60;

        $cookie = cookie('jwt', $token, config('jwt.ttl'));

        return response()->json([
            'access_token' => $token,
            'token_type' => $tokenType,
            'expires_in' => $expiresIn,
        ])->withCookie($cookie);
    }
}
