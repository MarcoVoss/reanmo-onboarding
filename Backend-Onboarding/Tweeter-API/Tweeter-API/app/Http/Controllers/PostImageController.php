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
        $this->middleware('can:delete,post')->only('destroy');
    }

    public function show(Post $post)
    {
        return response(ImageResource::make($post->image)) ?? [];
    }

    public function update(PostImageStoreRequest $request, Post $post)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $post->image?->delete();
        $post->image = Image::create(['path' => $path]);
        return response(ImageResource::make($post->image), 201);
    }

    public function destroy(Post $post)
    {
        $path = public_path($post->image?->path);
        $post->image?->delete();
        File::delete($path ?? "");
        return response(status: 204);
    }
}
