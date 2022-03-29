<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentLikeResource;
use App\Models\Comment;

class CommentLikesController extends Controller
{
    public function store(Comment $comment) {
        $comment->likes()->toggle(auth()->user());
        return response(CommentLikeResource::make($comment), 201);
    }
}
