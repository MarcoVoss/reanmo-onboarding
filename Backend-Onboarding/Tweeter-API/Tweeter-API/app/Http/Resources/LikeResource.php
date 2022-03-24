<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user_id' => $this->whenLoaded('user')->id
        ];
    }
}
