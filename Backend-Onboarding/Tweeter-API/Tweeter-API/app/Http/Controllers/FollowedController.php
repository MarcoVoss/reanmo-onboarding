<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowedController extends Controller
{
    public function store(User $follows) {
        auth()->user()->followed()->toggle($follows);
        return response()->json([], 201);
    }
}
