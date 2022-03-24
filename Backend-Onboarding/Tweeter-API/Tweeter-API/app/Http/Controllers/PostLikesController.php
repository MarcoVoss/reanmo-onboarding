<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;

class PostLikesController extends Controller
{
    public function __construct() {
        parent::__construct('Post-User-Like-Relationship');
    }

    public function index(Post $post) {
        return response($post->users()->count());
    }

    public function destroy(Post $post) {
        $post->users()->detach(auth()->user());
        return response(status: 204);
    }

    public function store(Post $post) {
        $post->users()->syncWithoutDetaching(auth()->user());
        return response($this->index($post), 201);
    }
}
