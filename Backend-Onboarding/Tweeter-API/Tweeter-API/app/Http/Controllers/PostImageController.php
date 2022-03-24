<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
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
        return response(ImageResource::make($post->image));
    }

    public function store(ImageStoreRequest $request, Post $post)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $post->image->update(['path' => $path]);
        return response(PostResource::make($post));
    }

    public function update(ImageUpdateRequest $request, Post $post)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $post->image->update(['path' => $path]);
        return response(PostResource::make($post));
    }

    public function destroy(Post $post)
    {
        $path = public_path($post->image->path);
        $post->image->delete();
        if(File::exists($path))
            File::delete($path);
        return response(status: 204);
    }
}
