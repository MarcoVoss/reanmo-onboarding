<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostLikeResource;
use App\Models\Post;

class PostLikesController extends Controller
{
    public function __construct() {
        parent::__construct('Post-User-Like-Relationship');
    }

    public function show(Post $post) {
        return response(PostLikeResource::make($post));
    }

    public function destroy(Post $post) {
        $post->likes()->detach(auth()->user());
        return response(status: 204);
    }

    public function store(Post $post) {
        $user = auth()->user();
        $post->likes()->syncWithoutDetaching($user);
        return response(PostLikeResource::make($post), 201);
    }
}
