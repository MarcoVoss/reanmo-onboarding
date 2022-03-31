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
        $fields = $request->validated();
        if(!Hash::check($fields['current'], auth()->user()->password))
            return response('Bad Credentials', 401);
        auth()->user()->password = bcrypt($fields['password']);
        PasswordMailService::sendPasswordResetNotification(auth()->user()->email);
        return response()->json(UserResource::make(auth()->user()));
    }
}
