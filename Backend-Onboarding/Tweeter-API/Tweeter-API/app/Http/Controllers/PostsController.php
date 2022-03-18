<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
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
        return Post::find($id);
    }

    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'message' => 'required|string',
            'id' => 'required'
        ]);

        $post = Post::find($id);

        if(!$this->isMyPost($post))
            return $this->forbiddenAccess();

        $post->message = $fields['message'];

        if(!$post->save())
            return response('Could not be saved!', 500);
        return $this->success(204);
    }

    public function destroy($id)
    {
        if(!$this->isMyPost(Post::find($id)))
            return $this->forbiddenAccess();

        Post::destroy($id);
        return $this->success();
    }

    private function isMyPost($post) {
        return isset($post) and $post->user_id == $this->currentUserId();
    }
}
