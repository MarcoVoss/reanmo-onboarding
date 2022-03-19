<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostLike;

class PostLikesController extends Controller
{
    public function destroy($id) {
        $relationship = PostLike::all()
            ->where('user_id', $this->currentUserId())
            ->where('post_id', $id)
            ->first();

        if(!$relationship->exists())
            return $this->notFoundException();

        if(!$relationship->delete())
            return $this->failedException();

        return $this->success();
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'post_id' => 'required|int'
        ]);

        PostLike::create([
            'post_id' => $fields['post_id'],
            'user_id' => $this->currentUserId()
        ]);

        return $this->success(201);
    }
}
