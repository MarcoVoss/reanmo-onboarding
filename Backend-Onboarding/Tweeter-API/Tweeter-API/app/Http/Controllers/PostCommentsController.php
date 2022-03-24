<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;

class PostCommentsController extends Controller
{
    public function __construct()
    {
        parent::__construct("PostComments");
    }

    public function index(Post $post)
    {
        return response(CommentResource::collection($post->comments()->get()));
    }
}
