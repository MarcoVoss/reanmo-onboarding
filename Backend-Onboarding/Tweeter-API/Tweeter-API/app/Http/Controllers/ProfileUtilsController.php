<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;

class ProfileUtilsController extends Controller
{
    public function search(String $name)
    {
        $users = User::latest()->filterName($name)->with('follower')->paginate(15);
        return response()->json(UserResource::collection($users));
    }

    public function news()
    {
        $posts = Post::getByFollows(auth()->id())->loadCount(['likes', 'comments']);
        return response()->json(PostResource::collection($posts));
    }

    public function home()
    {
        return response()->json(PostResource::collection(auth()->user()->posts()->paginate(15)));
    }
}
