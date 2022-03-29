<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class ProfilesController extends Controller
{
    public function update(UserUpdateRequest $request)
    {
        $user = auth()->user();
        $user->update($request->validated());
        $user->load(['follower', 'followed', 'image']);
        return response()->json(UserResource::make($user));
    }

    public function destroy()
    {
        auth()->user()->delete();
        return response()->json(status: 204);
    }
}
