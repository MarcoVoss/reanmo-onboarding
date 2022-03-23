<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLikesStoreRequest;
use App\Http\Resources\PostLikeResource;

class PostLikesController extends Controller
{
    public function __construct() {
        parent::__construct('Post-User-Like-Relationship');
    }

    public function index() {
        return response(PostLikeResource::collection(auth()->user()->postLikes()->get()));
    }

    public function destroy($id) {
        auth()->user()->postLikes()->detach($id);
        return response(status: 204);
    }

    public function store(PostLikesStoreRequest $request) {
        $fields = $request->validated();
        $result = auth()->user()->postLikes()->syncWithoutDetaching($fields['post_id']);
        return response(PostLikeResource::collection($result), 201);
    }
}
