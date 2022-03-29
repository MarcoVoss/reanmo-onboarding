<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class ProfilesController extends Controller
{
    public function update(UserUpdateRequest $request)
    {
        auth()->user()->update($request->validated());
        return response(UserResource::make(auth()->user()));
    }

    public function destroy()
    {
        auth()->user()->delete();
        return response(status: 204);
    }
}
