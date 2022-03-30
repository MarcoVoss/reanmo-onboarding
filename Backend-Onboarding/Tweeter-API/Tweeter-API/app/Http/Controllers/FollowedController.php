<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;

class FollowedController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:follow,follows')->only('store');
    }

    public function store(User $follows) {
        auth()->user()->followed()->toggle($follows);
        $follows->load(['follower', 'followed']);
        return response()->json(UserResource::make($follows), 201);
    }
}
