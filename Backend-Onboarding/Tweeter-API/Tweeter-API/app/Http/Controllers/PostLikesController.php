<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;

class PostLikesController extends Controller
{
    public function store(Post $post)
    {
        $post->likes()->toggle(auth()->user());
        $post->loadCount(['likes', 'comments']);
        $post->load(["user"]);
        return response()->json(PostResource::make($post), 201);
    }
}
