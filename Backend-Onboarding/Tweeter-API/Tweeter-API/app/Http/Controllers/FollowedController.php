<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowerStoreRequest;
use App\Http\Resources\FollowerResource;
use App\Models\User;

class FollowedController extends Controller
{
    public function __construct() {
        parent::__construct('Followed');
    }

    public function index() {
        return response(FollowerResource::collection(auth()->user()->followed()->get()));
    }

    public function destroy(User $user, User $follows) {
        $user->followed()->detach($follows);
        return response(status: 204);
    }

    public function store(FollowerStoreRequest $request, User $user, User $follows) {
        $user->followed()->syncWithoutDetaching($follows);
        return response(status: 200);
    }
}
