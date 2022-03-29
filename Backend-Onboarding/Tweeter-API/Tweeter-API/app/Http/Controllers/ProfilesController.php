<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:update,user')->only('update');
        $this->middleware('can:delete,user')->only('destroy');
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

    public function destroy(User $user)
    {
        $user->delete();
        return response(status: 204);
    }
}
