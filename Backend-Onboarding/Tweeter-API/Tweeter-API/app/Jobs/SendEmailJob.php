<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $details;
    protected Mailable $content;

    public function __construct($details, $content)
    {
        $this->details = $details;
        $this->content = $content;
    }

    public function handle()
    {
        Mail::to($this->details['email'])->send($this->content);
    }
}
