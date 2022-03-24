<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function __construct()
    {
        parent::__construct("PostComments");
    }

    public function index(Post $post)
    {
        return response(CommentResource::collection($post->comments()->get()));
    }

    public function store(CommentStoreRequest $request, Post $post)
    {
        $fields = $request->validated();
        $fields['user_id'] = $this->currentUserId();
        return response(CommentResource::make($post->comments()->create($fields)), 201);
    }

    public function update(CommentUpdateRequest $request, Post $post, Comment $comment)
    {
        $comment->update($request->validated());
        return response(CommentResource::make($comment));
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return response(status: 204);
    }
}
