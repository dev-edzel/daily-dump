<?php

namespace App\Services;

use App\Events\UserRegisterEvent;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store(array $userDetails): User
    {
        $user = User::create([
            'name' => $userDetails['name'],
            'email' => $userDetails['email'],
            'password' => Hash::make($userDetails['password']),
        ]);

        UserRegisterEvent::dispatch($user);

        return $user;
    }
}
