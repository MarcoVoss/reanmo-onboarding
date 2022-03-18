<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function destroy($id) {
        $relationship = Follower::all()
            ->where('user_id', $id)
            ->where('followed_id', $this->currentUserId())
            ->first();

        if(!$relationship)
            return $this->forbiddenAccess();

        $relationship->delete();

        return $this->success();
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'follower_id' => 'required'
        ]);

        Follower::create([
            'follower_id' => $this->currentUserId(),
            'user_id' => $fields['follower_id']
        ]);
        return $this->success(201);
    }
}
