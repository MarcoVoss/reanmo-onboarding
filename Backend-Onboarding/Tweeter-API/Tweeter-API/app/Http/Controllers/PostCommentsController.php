<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;

class PostCommentsController extends Controller
{
    public function index(Post $post)
    {
        return response()->json(CommentResource::collection($post->comments()->paginate(15)));
    }
}
