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
        return Post::getByFollows($this->currentUserId());
    }

    public function show($id) {
        $post = $this->index()->find($id);

        if(!$post)
            $this->notFoundException();

        return $post;
    }
}
