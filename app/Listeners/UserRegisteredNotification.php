<?php

namespace App\Listeners;

use App\Events\RegisteredUser;
use App\Jobs\SendRegistrationWelcomeMail;
use App\Mail\DefaultMail;
use App\Mail\RegisteredWelcomeMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class UserRegisteredNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RegisteredUser  $event
     * @return void
     */
    public function handle(RegisteredUser $event)
    {
//      SendRegistrationWelcomeMail::dispatch($event->user);
        Mail::to($event->user->email)->send(new RegisteredWelcomeMail($event->user));
    }
}
