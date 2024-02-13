<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        $cookie = cookie('jwt', $token, config('jwt.ttl'));

        return response(compact('token'))->withCookie($cookie);
    }
}
