<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostImageStoreRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:update,post')->only('update');
    }

    public function update(PostImageStoreRequest $request, Post $post)
    {
        $fields = $request->validated();
        if(isset($fields['image'])) {
            $image = $fields['image'];
            $path = $this->saveImage($image, Str::uuid());
            $image = $post->image = Image::create(['path' => $path]);
            return response(ImageResource::make($image), 201);
        } else {
            $post->image = null;
            return response(status: 204);
        }
    }
}
