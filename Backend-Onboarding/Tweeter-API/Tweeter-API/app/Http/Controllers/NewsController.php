<?php

namespace App\Http\Controllers;

use App\Models\Post;

class NewsController extends Controller
{
    public function __construct()
    {
        parent::__construct('News');
    }

    public function index() {
        return Post::leftJoin('followers', 'followers.user_id', '=', "posts.user_id")
            ->where('followers.follower_id', '=', $this->currentUserId())
            ->get();
    }

    public function show($id) {
        $post = $this->index()->find($id);

        if(!$post)
            $this->notFoundException();

        return $post;
    }
}
