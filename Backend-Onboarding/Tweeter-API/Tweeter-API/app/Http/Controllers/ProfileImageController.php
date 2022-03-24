<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileImageDeleteRequest;
use App\Http\Requests\ProfileImageStoreRequest;
use App\Http\Requests\ProfileImageUpdateRequest;
use App\Http\Resources\ImageResource;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileImageController extends Controller
{
    public function __construct()
    {
        parent::__construct("PostImage");
    }

    public function show(User $user)
    {
        return response(ImageResource::make($user->image));
    }

    public function store(ProfileImageStoreRequest $request, User $user)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $image = $user->image->create(['path' => $path]);
        return response(ImageResource::make($image));
    }

    public function update(ProfileImageUpdateRequest $request, User $user)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $image = $user->image->update(['path' => $path]);
        return response(ImageResource::make($image));
    }

    public function destroy(ProfileImageDeleteRequest $request, User $user)
    {
        $request->validated();
        $path = public_path($user->image->path);
        $user->image->delete();
        if(File::exists($path))
            File::delete($path);
        return response(status: 204);
    }
}
