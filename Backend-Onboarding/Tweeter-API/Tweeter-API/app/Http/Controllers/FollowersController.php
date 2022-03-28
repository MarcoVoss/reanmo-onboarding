<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowerDeleteRequest;
use App\Http\Requests\FollowerStoreRequest;
use App\Http\Resources\FollowerResource;
use App\Models\User;

class FollowersController extends Controller
{
    public function __construct() {
        parent::__construct('Follower');
    }

    public function index(User $user) {
        return response(FollowerResource::collection($user->follower()->get()));
    }

    public function destroy(FollowerDeleteRequest $request, User $user, User $follower) {
        $user->follower()->detach($follower);
        return response(status: 204);
    }

    public function store(FollowerStoreRequest $request, User $user, User $follower) {
        $user->follower()->syncWithoutDetaching($follower);
        return response(FollowerResource::make($follower), 201);
    }
}
