<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentLike;

class CommentLikesController extends Controller
{
    public function destroy($id) {
        $like = CommentLike::find($id);
        if(!$like->exists())
            return $this->notFoundException();

        if(!$this->isMyComment($like))
            return $this->forbiddenAccess();

        if(!CommentLike::destroy($id))
            return $this->failedException();

        return $this->success();
    }

    public function store(Request $request) {
        $like = $request->validate([
           'comment_id' => 'required'
        ]);

        CommentLike::create([
           'user_id' => $this->currentUserId(),
           'comment_id' => $like['comment_id']
        ]);

        return $this->success();
    }

    private function isMyComment(CommentLike $like) {
        return $like->user_id == $this->currentUserId();
    }
}
