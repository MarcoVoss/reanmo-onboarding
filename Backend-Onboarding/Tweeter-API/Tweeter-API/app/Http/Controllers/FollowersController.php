<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowerStoreRequest;
use App\Http\Resources\FollowerResource;
use App\Models\UserUser;

class FollowersController extends Controller
{
    public function __construct() {
        parent::__construct('Follower');
    }

    public function index() {
        return auth()->user()->follower()->get();
    }

    public function destroy(UserUser $follower) {
        $follower->delete();
        return response(status: 204);
    }

    public function store(FollowerStoreRequest $request) {
        $fields = $request->validated();

        $follower = UserUser::create([
            'follower_id' => $this->currentUserId(),
            'user_id' => $fields['follower_id']
        ]);

        return response(FollowerResource::make($follower), 201);
    }
}
