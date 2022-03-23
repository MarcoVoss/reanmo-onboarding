<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentLikeStoreRequest;
use App\Http\Resources\CommentLikeResource;

class CommentLikesController extends Controller
{
    public function __construct() {
        parent::__construct('Comment-User-Like-Relationship');
    }

    public function index() {
        return response(CommentLikeResource::collection(auth()->user()->commentLikes()->get()));
    }

    public function destroy($id) {
        auth()->user()->commentLikes()->detach($id);
        return response(status: 204);
    }

    public function store(CommentLikeStoreRequest $request) {
        $fields = $request->validated();
        $result = auth()->user()->commentLikes()->syncWithoutDetaching($fields['comment_id']);
        return response(CommentLikeResource::collection($result), 201);
    }
}
