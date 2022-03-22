<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowerStoreRequest;
use App\Http\Resources\FollowerResource;
use App\Models\Follower;
use Illuminate\Support\Facades\Log;

class FollowersController extends Controller
{
    public function __construct() {
        parent::__construct('Follower');
    }

    public function index() {
        return Follower::getAllByFollowerId($this->currentUserId());
    }

    public function destroy(Follower $follower) {
        Log::info($follower);

//        $relationship = Follower::getFirstByUserAndFollower($id, $this->currentUserId());

//        if(!$relationship)
//            return $this->notFoundException();
//
//        if(!$relationship->delete())
//            return $this->failedException();

        return response(status: 204);
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
