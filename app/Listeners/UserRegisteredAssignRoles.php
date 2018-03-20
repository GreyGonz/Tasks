<?php

namespace App\Listeners;

use App\Events\RegisteredUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredAssignRoles
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
     * @param  object  $event
     * @return void
     */
    public function handle(RegisteredUser $event)
    {
      $user = $event->user;
      $user->assignRole('user');
    }
}
