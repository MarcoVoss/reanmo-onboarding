<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FollowerResource extends JsonResource
{
    public function toArray($request)
    {
        return UserResource::make($this);
    }
}
