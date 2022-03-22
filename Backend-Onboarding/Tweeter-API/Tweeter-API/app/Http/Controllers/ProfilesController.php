<?php

namespace App\Http\Controllers;


use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Requests\IdRequest;
use App\Requests\UserUpdateRequest;
use App\Requests\UserSearchRequest;

class ProfilesController extends Controller
{
    public function __construct() {
        parent::__construct('Profile');
    }

    public function index()
    {
        return new UserCollection(User::all());
    }

    public function search(UserSearchRequest $request)
    {
        $fields = $request->validated();
        return new UserCollection(User::latest()->filterName($fields['name'])->get());
    }

    public function show($id)
    {
        $user = User::find($id);
        if(!$user)
            return $this->notFoundException();
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        if(!$user)
            return $this->notFoundException();

        if(!$this->isMyProfile($user))
            return $this->forbiddenAccess();

        $fields = $request->validated();
        $user->name = $fields['name'] ?? $user->name;
        $user->image = $fields['image'] ?? $user->image;
        $user->email = $fields['email'] ?? $user->email;
        $user->password = $fields['password'] ?? $user->password;
        $user->save();
        return $this->success();
    }

    public function destroy($id)
    {
        $user = $this->show($id);

        if(!$user)
            return $this->notFoundException();

        if(!$this->isMyProfile($user))
            return $this->forbiddenAccess();

        $user->delete();
        return $this->success();
    }

    public function showMe()
    {
        return new UserResource($this->show($this->currentUserId()));
    }

    private function isMyProfile(User $user)
    {
        return $user->id == $this->currentUserId();
    }
}
