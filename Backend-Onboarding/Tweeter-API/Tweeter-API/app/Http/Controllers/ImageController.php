<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function __construct() {
        parent::__construct('Image');
    }

    public function store(ImageStoreRequest $request)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $image = Image::create([
            'path' => $path
        ]);
        return response(ImageResource::make($image), 201);
    }

    public function show(Image $image)
    {
        return response(ImageResource::make($image));
    }

    public function update(ImageUpdateRequest $request, Image $image)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $image->update([
            'path' => $path
        ]);
        return response(ImageResource::make($image));
    }

    public function destroy(Image $image)
    {
        $image->delete();
        return response(204);
    }

    private function saveImage(UploadedFile $image, $fileName) {
        return $image->storeAs('images', "$fileName.{$image->extension()}", 'public');
    }
}
