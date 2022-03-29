<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileImageStoreRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileImageController extends Controller
{
    public function update(ProfileImageStoreRequest $request)
    {
        $user = auth()->user();
        $fields = $request->validated();
        if(isset($fields['image'])) {
            $image = $fields['image'];
            $path = $this->saveImage($image, Str::uuid());
            $image = $user->image = Image::create(['path' => $path]);
            return response()->json(ImageResource::make($image), 201);
        } else {
            $user->image = null;
            return response()->json(status: 204);
        }
    }
}
