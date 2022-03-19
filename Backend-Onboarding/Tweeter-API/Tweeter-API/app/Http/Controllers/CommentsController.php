<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        return Comment::all()->where('user_id', $this->currentUserId());
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'post_id' => 'required',
            'message' => 'required|string'
        ]);

        Comment::create([
            'post_id' => $fields['post_id'],
            'message' => $fields['message']
        ]);

        return $this->success(201);
    }

    public function show($id)
    {
        return Comment::find($id);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        if(!$comment->exists())
            return $this->notFoundException();

        if(!$this->isMyComment($comment))
            return $this->forbiddenAccess();

        $fields = $request->validate([
            'message' => 'required|string'
        ]);

        $comment->message = $fields['message'];
        $comment->save();

        return $this->success();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(!$comment->exists())
            return $this->notFoundException();

        if(!$this->isMyComment($comment))
            return $this->forbiddenAccess();

        if(!Comment::destroy($id))
            return $this->failedException();

        return $this->success();
    }

    private function isMyComment($comment) {
        return isset($comment) and $comment->user_id == $this->currentUserId();
    }
}
