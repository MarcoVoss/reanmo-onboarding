<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? -1,
            'image_path' => url(Storage::url($this->path ?? ""))
        ];

    }
}
