<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostLikeResource;
use App\Models\Post;

class PostLikesController extends Controller
{
    public function show(Post $post)
    {
        return response(PostLikeResource::make($post));
    }

    public function destroy(Post $post)
    {
        $post->likes()->detach(auth()->user());
        return response(status: 204);
    }

    public function store(Post $post)
    {
        $post->likes()->syncWithoutDetaching(auth()->user());
        return response(PostLikeResource::make($post), 201);
    }
}
