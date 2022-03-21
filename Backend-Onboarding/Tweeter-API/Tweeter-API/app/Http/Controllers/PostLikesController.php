<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use App\Requests\PostLikesStoreRequest;

class PostLikesController extends Controller
{
    public function __construct() {
        parent::__construct('Post-User-Like-Relationship');
    }

    public function destroy($id) {
        $relationship = PostLike::getOne($this->currentUserId(), $id);

        if(!$relationship)
            return $this->notFoundException();

        if(!$relationship->delete())
            return $this->failedException();

        return $this->success();
    }

    public function store(PostLikesStoreRequest $request) {
        $fields = $request->validated();

        PostLike::create([
            'post_id' => $fields['post_id'],
            'user_id' => $this->currentUserId()
        ]);

        return $this->success(201);
    }
}
