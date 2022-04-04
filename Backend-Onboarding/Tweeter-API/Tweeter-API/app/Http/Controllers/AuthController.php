<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserStoreRequest $request) {
        $fields = $request->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);
        $user->load('image', 'follower');
        return response()->json(UserResource::make($user), 201);
    }

    public function login(UserLoginRequest $request) {
        $fields = $request->validated();

        $user = User::getByEmail($fields['email']);

        if(!$user || !Hash::check($fields['password'], $user->password))
            return response('Bad Credentials', 401);

        $token = $user->createToken('token');
        return response()->json(LoginResource::make($user, $token));
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json(status: 204);
    }
}
