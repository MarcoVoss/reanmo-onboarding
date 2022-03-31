<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function update(PasswordResetRequest $request)
    {
        $fields = $request->validated();
        if(!Hash::check($fields['current'], auth()->user()->password))
            return response('Bad Credentials', 401);
        auth()->user()->password = bcrypt($fields['password']);
        return response()->json(UserResource::make(auth()->user()), 200);
    }
}
