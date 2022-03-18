<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentLike;

class CommentLikesController extends Controller
{
    public function destroy($id) {
        if(!$this->isMyComment(CommentLike::find($id)))
            return $this->forbiddenAccess();
        CommentLike::destroy($id);
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

    private function isMyComment($comment) {
        return isset($comment) and $comment->user_id == $this->currentUserId();
    }
}
