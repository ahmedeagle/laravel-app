<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return ['error' => 'Unauthorized', 'status' => 401];
        }

        $user = Auth::user();
        return [
            'token' => $user->createToken('API Token')->plainTextToken,
            'user' => $user
        ];
    }
}
