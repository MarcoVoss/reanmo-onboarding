<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Requests\CommentStoreRequest;
use App\Requests\CommentUpdateRequest;

class CommentsController extends Controller
{
    public function __construct() {
        parent::__construct('Comment');
    }

    public function index()
    {
        return Comment::all()->where('user_id', $this->currentUserId());
    }

    public function store(CommentStoreRequest $request)
    {
        $fields = $request->validated();

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

    public function update(CommentUpdateRequest $request, $id)
    {
        $comment = Comment::find($id);
        if(!$comment)
            return $this->notFoundException();

        if(!$this->isMyComment($comment))
            return $this->forbiddenAccess();

        $fields = $request->validated();

        $comment->message = $fields['message'];
        $comment->save();

        return $this->success();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(!$comment)
            return $this->notFoundException();

        if(!$this->isMyComment($comment))
            return $this->forbiddenAccess();

        if(!Comment::destroy($id))
            return $this->failedException();

        return $this->success();
    }

    private function isMyComment(Comment $comment) {
        return $comment->user_id == $this->currentUserId();
    }
}
