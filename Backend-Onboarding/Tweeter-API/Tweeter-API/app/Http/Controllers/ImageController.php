<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ImageResource;
use App\Models\Comment;
use App\Models\Image;

class ImageController extends Controller
{
    public function __construct() {
        parent::__construct('Image');
    }

    public function store(ImageStoreRequest $request)
    {
        $image = Image::create($request->validated());
        return response(ImageResource::make($image), 201);
    }

    public function show(Image $image)
    {
        return response(ImageResource::make($image));
    }

    public function update(ImageUpdateRequest $request, Image $image)
    {
        $image->update($request->validated());
        return response(ImageResource::make($image));
    }

    public function destroy(Image $image)
    {
        $image->delete();
        return response(204);
    }
}
