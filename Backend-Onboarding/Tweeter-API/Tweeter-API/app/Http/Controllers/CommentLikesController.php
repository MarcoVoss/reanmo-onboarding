<?php

namespace App\Http\Controllers;

use App\Requests\CommentLikeStoreRequest;
use App\Models\CommentLike;

class CommentLikesController extends Controller
{
    public function __construct() {
        parent::__construct('Comment-User-Like-Relationship');
    }

    public function destroy($id) {
        $like = CommentLike::find($id);
        if(!$like)
            return $this->notFoundException();

        if(!$this->isMyComment($like))
            return $this->forbiddenAccess();

        if(!CommentLike::destroy($id))
            return $this->failedException();

        return $this->success();
    }

    public function store(CommentLikeStoreRequest $request) {
        $like = $request->validated();

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
