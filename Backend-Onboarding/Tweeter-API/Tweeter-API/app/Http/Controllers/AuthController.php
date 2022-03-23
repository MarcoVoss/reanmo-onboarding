<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct() {
        parent::__construct('Auth');
    }

    public function register(UserStoreRequest $request) {
        $fields = $request->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'image_id' => $fields['image_id'] ?? null
        ]);

        return response(UserResource::make($user), 201);
    }

    public function login(UserLoginRequest $request) {
        $fields = $request->validated();

        $user = User::getByEmail($fields['email']);

        if(!$user || !Hash::check($fields['password'], $user->password))
            return response('Bad Credentials', 401);

        return [
            'user' => $user,
            'token' => $user->createToken('token')
        ];
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response();
    }
}
