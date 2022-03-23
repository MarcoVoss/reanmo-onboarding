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
        return response(FollowerResource::collection(auth()->user()->followed()->get()));
    }

    public function destroy($id) {
        auth()->user()->followed()->detach($id);
        return response(status: 204);
    }

    public function store(FollowerStoreRequest $request) {
        $fields = $request->validated();
        auth()->user()->followed()->syncWithoutDetaching($fields['follower_id']);
        return response(status: 200);
    }
}
