<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;

class PostCommentsController extends Controller
{
    public function index(Post $post)
    {
        return response()->json(CommentResource::collection($post->comments()->paginate(15)));
    }

    public function store(CommentStoreRequest $request, Post $post)
    {
        $fields = $request->validated();
        $fields['user_id'] = auth()->id();
        $comment = $post->comments()->create($fields);
        $comment->load(['likes', 'user']);
        return response()->json(CommentResource::make($comment), 201);
    }
}
