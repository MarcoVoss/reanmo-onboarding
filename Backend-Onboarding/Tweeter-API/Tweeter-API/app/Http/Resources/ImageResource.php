<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
            ],
            'links' => [
                'image_path' => env('APP_URL').':'.env('APP_PORT').Storage::url($this->path),
            ]
        ];
    }
}
