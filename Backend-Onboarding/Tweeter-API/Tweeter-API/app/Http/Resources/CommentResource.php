<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Comment
 */
class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'user' => UserResource::make($this->whenLoaded('user')),
            'likes' => $this->whenLoaded('likes', function () {
                return $this->likes->count();
            }),
        ];
    }
}
