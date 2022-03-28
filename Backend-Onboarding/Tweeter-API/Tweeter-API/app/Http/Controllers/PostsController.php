<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostDeleteRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostsController extends Controller
{
    public function __construct() {
        parent::__construct('Post');
    }

    public function index()
    {
        return response(PostResource::collection(Post::all()));
    }

    public function store(PostStoreRequest $request)
    {
        $fields = $request->validated();

        $post = Post::create([
            'message' => $fields['message'],
            'user_id' => $this->currentUserId(),
        ]);

        return response(PostResource::make($post), 201);
    }

    public function show(Post $post)
    {
        return response(PostResource::make($post));
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->validated());
        return response(PostResource::make($post));
    }

    public function destroy(PostDeleteRequest $request, Post $post)
    {
        $post->delete();
        return response(status: 204);
    }
}
