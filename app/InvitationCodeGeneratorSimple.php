<?php

namespace App;

class InvitationCodeGeneratorSimple implements InvitationCodeGenerator
{
  public function generate()
  {
    return 'INVITATION_CODE_123';
  }
}
