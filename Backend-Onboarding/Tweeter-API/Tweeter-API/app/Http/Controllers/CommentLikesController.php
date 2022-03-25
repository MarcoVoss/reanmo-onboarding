<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentLikeResource;
use App\Models\Comment;

class CommentLikesController extends Controller
{
    public function __construct() {
        parent::__construct('Comment-User-Like-Relationship');
    }

    public function show(Comment $comment) {
        return response(CommentLikeResource::make($comment));
    }

    public function destroy(Comment $comment) {
        $comment->likes()->detach(auth()->user());
        return response(status: 204);
    }

    public function store(Comment $comment) {
        $comment->likes()->syncWithoutDetaching(auth()->user());
        return response(CommentLikeResource::make($comment), 201);
    }
}
