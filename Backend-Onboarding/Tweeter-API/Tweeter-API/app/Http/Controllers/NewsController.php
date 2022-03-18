<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Follower;

class NewsController extends Controller
{
    public function index() {
        return Post::leftJoin('followers', 'followers.user_id', '=', "posts.user_id")
            ->where('followers.follower_id', '=', $this->currentUserId())
            ->get();
    }

    public function show($id) {
        return Post::find($id);
    }
}
