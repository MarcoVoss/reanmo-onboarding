<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentLikeStoreRequest;
use App\Http\Resources\CommentLikeResource;
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

        return response(status: 204);
    }

    public function store(CommentLikeStoreRequest $request) {
        $fields = $request->validated();

        $like = CommentLike::create([
           'user_id' => $this->currentUserId(),
           'comment_id' => $fields['comment_id']
        ]);

        return response(CommentLikeResource::make($like), 201);
    }

    private function isMyComment(CommentLike $like) {
        return $like->user_id == $this->currentUserId();
    }
}
