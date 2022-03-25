<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSearchRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;

class ProfileUtilsController extends Controller
{
    public function __construct()
    {
        parent::__construct("ProfileUtils");
    }

    public function search(String $name)
    {
        $users = User::latest()->filterName($name)->get();
        return response(UserResource::collection($users));
    }

    public function news()
    {
        $posts = Post::getByFollows($this->currentUserId());
        return response(PostResource::collection($posts));
    }
}
