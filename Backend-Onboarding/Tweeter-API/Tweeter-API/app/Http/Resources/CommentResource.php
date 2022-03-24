<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'post' => PostResource::make($this->whenLoaded('post')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
