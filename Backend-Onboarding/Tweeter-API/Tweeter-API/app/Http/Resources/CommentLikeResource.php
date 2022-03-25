<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentLikeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'count' => $this->likes()->count(),
            'users' => UserResource::collection($this->likes()->get())
        ];
    }
}
