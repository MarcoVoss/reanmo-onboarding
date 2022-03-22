<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;

class NewsController extends Controller
{
    public function __construct()
    {
        parent::__construct('News');
    }

    public function index() {
        $posts = Post::getByFollows($this->currentUserId());
        return response(PostResource::collection($posts));
    }

    public function show(Post $post) {
        return response(PostResource::make($post));
    }
}
