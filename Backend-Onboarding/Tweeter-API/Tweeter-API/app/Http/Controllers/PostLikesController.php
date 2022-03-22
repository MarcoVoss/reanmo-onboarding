<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLikesStoreRequest;
use App\Http\Resources\PostLikeResource;
use App\Models\PostLike;

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

        return $this->success($relationship);
    }

    public function store(PostLikesStoreRequest $request) {
        $fields = $request->validated();

        $like = PostLike::create([
            'post_id' => $fields['post_id'],
            'user_id' => $this->currentUserId()
        ]);

        return response(PostLikeResource::make($like), 201);
    }
}
