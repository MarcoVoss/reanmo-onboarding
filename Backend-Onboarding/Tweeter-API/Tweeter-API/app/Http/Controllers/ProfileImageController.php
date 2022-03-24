<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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

    public function store(ImageStoreRequest $request, User $user)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $user->image->update(['path' => $path]);
        return response(UserResource::make($user));
    }

    public function update(ImageUpdateRequest $request, User $user)
    {
        $fields = $request->validated();
        $path = $this->saveImage($fields['image'], Str::uuid());
        $user->image->update(['path' => $path]);
        return response(UserResource::make($user));
    }

    public function destroy(User $user)
    {
        $path = public_path($user->image->path);
        $user->image->delete();
        if(File::exists($path))
            File::delete($path);
        return response(status: 204);
    }
}
