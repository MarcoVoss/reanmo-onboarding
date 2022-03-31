<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return  $this->from('mail@example.com', 'Mailtrap')
            ->subject(config("mail.content.main_title").": Password reset information")
            ->markdown('password_reset');
    }
}
