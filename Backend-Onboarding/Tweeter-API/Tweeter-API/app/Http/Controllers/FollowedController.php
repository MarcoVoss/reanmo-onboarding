<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowerDeleteRequest;
use App\Http\Requests\FollowerStoreRequest;
use App\Http\Resources\FollowerResource;
use App\Models\User;

class FollowedController extends Controller
{
    public function store(User $follows) {
        auth()->user()->followed()->toggle($follows);
        return response(FollowerResource::make($follows), 201);
    }
}
