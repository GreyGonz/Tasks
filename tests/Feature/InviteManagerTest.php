<?php

namespace Tests\Feature;

use App\Invitation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InviteManagerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function invite_manager_via_cli()
    {
      $this->artisan('invite-manager', [
        'email' => 'pepe@gmail.com'
      ]);

      // Invitation: email, code

      $invitation = Invitation::first();
      $this->assertEquals('pepe@gmail.com', $invitation->email);
      $this->assertEquals('INVITATION_CODE_123', $invitation->code);

      // S'ha enviat un email
      // Mail::assertSent

      //
    }
}
