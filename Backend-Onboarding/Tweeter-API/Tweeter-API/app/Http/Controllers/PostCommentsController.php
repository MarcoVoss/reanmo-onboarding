<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;

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
        $comment = $post->comments()->create($fields);
        return response(CommentResource::make($comment), 201);
    }
}
