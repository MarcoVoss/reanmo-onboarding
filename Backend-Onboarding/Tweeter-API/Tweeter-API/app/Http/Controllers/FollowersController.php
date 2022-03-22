<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowerStoreRequest;
use App\Http\Resources\FollowerResource;
use App\Models\Follower;

class FollowersController extends Controller
{
    public function __construct() {
        parent::__construct('Follower');
    }

    public function index() {
        return Follower::getAllByFollowerId($this->currentUserId());
    }

    public function destroy($id) {
        $relationship = Follower::getFirstByUserAndFollower($id, $this->currentUserId());

        if(!$relationship)
            return $this->notFoundException();

        if(!$relationship->delete())
            return $this->failedException();

        return $this->success();
    }

    public function store(FollowerStoreRequest $request) {
        $fields = $request->validated();

        $follower = Follower::create([
            'follower_id' => $this->currentUserId(),
            'user_id' => $fields['follower_id']
        ]);

        return response(FollowerResource::make($follower), 201);
    }
}
