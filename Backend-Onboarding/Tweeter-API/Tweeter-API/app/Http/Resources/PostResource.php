<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Post
 */
class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->user),
            'image' => ImageResource::make($this->image),
            'message' => $this->message,
            'created_at' => $this->created_at,
            'liked' =>  $this->whenLoaded('likes', function () {
                return $this->likes->where('pivot.user_id', '=', auth()->id())->isNotEmpty();
            }),
            'likes' =>  $this->whenLoaded('likes', function () {
                return $this->likes->count();
            }),
            'comments' => $this->whenLoaded('comments', function () {
                return $this->comments->count();
            }),
        ];
    }
}
