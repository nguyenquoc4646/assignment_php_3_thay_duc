<?php

namespace App\Listeners;

use App\Events\ForgotPasswordEvent;
use App\Mail\UpdatePassword;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UpdatePasswordAfterForgot implements ShouldQueue
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
    public function handle(ForgotPasswordEvent $event): void
    {
        $email = $event->email;
        $user = User::checkEmail($email);
        $mail = new UpdatePassword($user);
        Mail::to($email)->send($mail);
    }
}