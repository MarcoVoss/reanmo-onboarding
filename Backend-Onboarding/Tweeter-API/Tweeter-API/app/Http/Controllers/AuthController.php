<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Requests\UserLoginRequest;
use App\Requests\UserStoreRequest;
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
            'image' => $fields['image']
        ]);

        return $this->_login($user);
    }

    public function login(UserLoginRequest $request) {
        $fields = $request->validated();

        $user = User::getByEmail($fields['email']);

        if(!$user->exists() || !Hash::check($fields['password'], $user->password))
            return response('Bad Credentials', 401);

        return $this->_login($user);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return $this->success();
    }

    private function _login($user) {
        return [
            'user' => $user,
            'token' => $user->createToken('token')
        ];
    }
}
