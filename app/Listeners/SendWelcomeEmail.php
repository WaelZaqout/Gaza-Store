<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Auth\Events\Registered;
use App\Notifications\NewUserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
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
    // public function handle(Registered $event): void
    // {
    //     $event->user->notify(NewUserRegister());
    // }
    public function handle(UserRegistered $event): void
    {
        $event->user->notify(new NewUserRegistered());
    }
}
