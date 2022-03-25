<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostImageDeleteRequest;
use App\Http\Requests\PostImageStoreRequest;
use App\Http\Requests\PostImageUpdateRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostImageController extends Controller
{
    public function __construct()
    {
        parent::__construct("PostImage");
    }

    public function show(Post $post)
    {
        return response(ImageResource::make($post->image)) ?? [];
    }

    public function store(PostImageStoreRequest $request, Post $post)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $post->image?->delete();
        $post->image = Image::create(['path' => $path]);
        return response(ImageResource::make($post->image), 201);
    }

    public function destroy(PostImageDeleteRequest $request, Post $post)
    {
        $request->validated();
        $path = public_path($post->image?->path);
        $post->image?->delete();
        File::delete($path ?? "");
        return response(status: 204);
    }
}
