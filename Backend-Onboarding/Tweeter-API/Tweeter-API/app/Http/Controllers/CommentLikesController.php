<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentLikesController extends Controller
{
    public function store(Comment $comment) {
        $comment->likes()->toggle(auth()->user());
        return response()->json(CommentResource::make($comment), 201);
    }
}
