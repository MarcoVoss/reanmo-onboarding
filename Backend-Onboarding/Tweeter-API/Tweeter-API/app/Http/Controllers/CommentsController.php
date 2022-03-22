<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function __construct() {
        parent::__construct('Comment');
    }

    public function index()
    {
        $comments = Comment::byUser($this->currentUserId());
        return response(CommentResource::collection($comments));
    }

    public function store(CommentStoreRequest $request)
    {
        $comment = Comment::create($request->validated());
        return response(CommentResource::make($comment), 201);
    }

    public function show(Comment $comment)
    {
        return response(CommentResource::make($comment));
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return response(CommentResource::make($comment));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response(204);
    }
}
