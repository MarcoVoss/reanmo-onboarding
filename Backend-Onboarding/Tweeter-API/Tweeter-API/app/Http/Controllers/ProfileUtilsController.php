<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSearchRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;

class ProfileUtilsController extends Controller
{
    public function search(UserSearchRequest $request)
    {
        $fields = $request->validated();
        $users = User::latest()->filterName($fields['name'])->get();
        return response(UserResource::collection($users));
    }

    public function news()
    {
        $posts = Post::getByFollows($this->currentUserId());
        return response(PostResource::collection($posts));
    }
}
