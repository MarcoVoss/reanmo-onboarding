<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentDeleteRequest;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:update,comment')->only('update');
        $this->middleware('can:delete,comment')->only('destroy');
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment->load(['likes', 'user']);
        $comment->update($request->validated());
        return response()->json(CommentResource::make($comment));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(status:204);
    }
}
