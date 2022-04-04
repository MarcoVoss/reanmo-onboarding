<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Resources\UserResource;
use App\Http\Service\PasswordMailService;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function update(PasswordResetRequest $request)
    {
        $user = auth()->user();
        $fields = $request->validated();
        if(!Hash::check($fields['current'], $user->password))
            return response('Bad Credentials', 401);
        $user->password = bcrypt($fields['password']);
        PasswordMailService::sendPasswordResetNotification($user->email);
        $user->load('image', 'follower');
        return response()->json(UserResource::make($user));
    }
}
