<?php

namespace App\Listeners;

use App\Events\RegisterSuccessEvent;
use App\Mail\RegisterMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class VerifyEmailAfter implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegisterSuccessEvent $event): void
    {
        $user = $event->user;
        $mail = new RegisterMail($user);
        Mail::to($user->email)->send($mail);
    }
}
