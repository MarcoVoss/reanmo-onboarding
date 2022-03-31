<?php

namespace App\Http\Service;

use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;

class PasswordMailService {
    public static function sendPasswordResetNotification(string $target)
    {
        Mail::to($target)->send(new PasswordResetMail());
    }
}
