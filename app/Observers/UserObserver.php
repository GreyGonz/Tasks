<?php

namespace App\Observer;

use App\Events\RegisteredUser;
use App\User;

class UserObserver {

  public function created(User $user)
  {
    event(new RegisteredUser($user));
  }
}