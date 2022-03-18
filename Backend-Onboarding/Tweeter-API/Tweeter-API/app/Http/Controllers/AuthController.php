<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'image' => 'nullable',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'image' => $fields['image']
        ]);

        return $this->_login($user);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Bad Credentials'], 401);
        }

        return $this->_login($user);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response(['message' => 'logged out'], 200);
    }

    private function _login($user) {
        $token = $user->createToken('token');

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }
}
