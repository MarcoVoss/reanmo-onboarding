<?php

namespace App\Http\Controllers;


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

    public function search(UserSearchRequest $request)
    {
        $fields = $request->validated();
        $users = User::latest()->filterName($fields['name'])->get();
        return response(UserResource::collection($users));
    }

    public function show(User $user)
    {
        return response(UserResource::make($user));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($this->forbiddenAccess());
        return response(UserResource::make($user));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response(status: 204);
    }

    public function showMe()
    {
        $user = $this->show($this->currentUserId());
        return response(UserResource::make($user));
    }
}
