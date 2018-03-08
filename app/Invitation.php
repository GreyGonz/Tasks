<?php

namespace App;

use App\Mail\ManagerInvitationEmail;
use Illuminate\Database\Eloquent\Model;
use Mail;

class Invitation extends Model
{
  protected $guarded = [];

  public function send()
  {
    Mail::to($this->email)->send(new ManagerInvitationEmail($this));
  }
}
