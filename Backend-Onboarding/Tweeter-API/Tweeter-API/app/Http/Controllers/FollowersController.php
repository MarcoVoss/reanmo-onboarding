<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Requests\CommentUpdateRequest;
use App\Requests\FollowerStoreRequest;

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

        Follower::create([
            'follower_id' => $this->currentUserId(),
            'user_id' => $fields['follower_id']
        ]);

        return $this->success(201);
    }
}
