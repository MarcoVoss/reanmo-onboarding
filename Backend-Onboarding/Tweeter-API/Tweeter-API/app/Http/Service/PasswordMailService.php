<?php

namespace App\Http\Service;

use App\Jobs\SendEmailJob;
use App\Mail\PasswordResetMail;

class PasswordMailService {
    public static function sendPasswordResetNotification(string $target)
    {
        dispatch(new SendEmailJob(['email' => $target], new PasswordResetMail()));
    }
}
