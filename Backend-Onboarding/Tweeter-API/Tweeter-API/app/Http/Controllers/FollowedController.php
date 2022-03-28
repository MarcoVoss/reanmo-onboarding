<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowerDeleteRequest;
use App\Http\Requests\FollowerStoreRequest;
use App\Http\Resources\FollowerResource;
use App\Models\User;

class FollowedController extends Controller
{
    public function __construct() {
        parent::__construct('Followed');
    }

    public function index(User $user) {
        return response(FollowerResource::collection($user->followed()->get()));
    }

    public function destroy(FollowerDeleteRequest $request, User $user, User $follows) {
        $request->validated();
        $user->followed()->detach($follows);
        return response(status: 204);
    }

    public function store(FollowerStoreRequest $request, User $user, User $follows) {
        $request->validated();
        $user->followed()->syncWithoutDetaching($follows);
        return response(FollowerResource::make($follows), 201);
    }
}
