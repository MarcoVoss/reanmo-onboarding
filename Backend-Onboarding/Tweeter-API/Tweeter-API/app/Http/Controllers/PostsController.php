<?php

namespace App\Http\Controllers;

use App\Requests\PostStoreRequest;
use App\Requests\PostUpdateRequest;
use App\Models\Post;

class PostsController extends Controller
{
    public function __construct() {
        parent::__construct('Post');
    }

    public function index()
    {
        return Post::all()->where('user_id', $this->currentUserId());
    }

    public function store(PostStoreRequest $request)
    {
        $fields = $request->validated();

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

    public function update(PostUpdateRequest $request, $id)
    {
        $post = $this->index()->find($id);

        if(!$post)
            return $this->notFoundException();

        if(!$this->isMyPost($post))
            return $this->forbiddenAccess();

        $fields = $request->validated();

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
