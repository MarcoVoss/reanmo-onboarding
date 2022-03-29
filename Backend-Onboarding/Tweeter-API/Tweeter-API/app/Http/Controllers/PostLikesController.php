<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostLikeResource;
use App\Models\Post;

class PostLikesController extends Controller
{
    public function store(Post $post)
    {
        $post->likes()->toggle(auth()->user());
        return response(PostLikeResource::make($post), 201);
    }
}
