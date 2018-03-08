<?php

namespace App;

class InvitationCodeGeneratorComplex implements InvitationCodeGenerator
{
    public function generate()
    {
      return str_random(60);
    }
}
