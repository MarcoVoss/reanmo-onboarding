<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserDeleteRequest;
use App\Http\Requests\UserSearchRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class ProfilesController extends Controller
{
    public function __construct() {
        parent::__construct('Profile');
    }

    public function index()
    {
        return response(UserResource::collection(User::all()));
    }

    public function show(User $user)
    {
        return response(UserResource::make($user));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        return response(UserResource::make($user));
    }

    public function destroy(UserDeleteRequest $request, User $user)
    {
        $request->validated();
        $user->delete();
        return response(status: 204);
    }
}
