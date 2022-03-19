<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostsController extends Controller
{
    public function __construct() {
        parent::__construct('Post');
    }

    public function index()
    {
        return Post::all()->where('user_id', $this->currentUserId());
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'message' => 'required|string',
        ]);

        Post::create([
            'message' => $fields['message'],
            'user_id' => $this->currentUserId(),
        ]);

        return $this->success(201);
    }

    public function show($id)
    {
        $post = $this->index()->find($id);

        if(!$post)
            return $this->notFoundException();

        return $post;
    }

    public function update(Request $request, $id)
    {
        $post = $this->index()->find($id);

        if(!$post)
            return $this->notFoundException();

        if(!$this->isMyPost($post))
            return $this->forbiddenAccess();

        $fields = $request->validate([
            'message' => 'required|string',
            'id' => 'required'
        ]);

        $post->message = $fields['message'];

        if(!$post->save())
            return $this->failedException();

        return $this->success(204);
    }

    public function destroy($id)
    {
        $post = $this->index()->find($id);
        if(!$post)
            return $this->notFoundException();

        if(!$this->isMyPost($post))
            return $this->forbiddenAccess();

        if(!Post::destroy($id))
            return $this->failedException();

        return $this->success();
    }

    private function isMyPost(Post $post) {
        return $post->user_id == $this->currentUserId();
    }
}
