<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->whenLoaded('user')),
            'image' => ImageResource::make($this->whenLoaded('image')),
            'message' => $this->message,
            'created_at' => $this->created_at
        ];
    }
}
