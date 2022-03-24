<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentDeleteRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function __construct() {
        parent::__construct('Comment');
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return response(CommentResource::make($comment));
    }

    public function destroy(CommentDeleteRequest $request, Comment $comment)
    {
        $request->validated();
        $comment->delete();
        return response(204);
    }
}
