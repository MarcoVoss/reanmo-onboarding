<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => ImageResource::make($this->whenLoaded('image')),
            'follows' =>  $this->whenLoaded('follower', function () {
                return $this->follower->where('pivot.follower_id', '=', auth()->id())->isNotEmpty();
            }),
        ];
    }
}
