<?php

namespace Tests\Feature;

use App\Facades\InvitationCode;
use App\Invitation;
use App\Mail\ManagerInvitationEmail;
use Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InviteManagerTest extends TestCase
{

    use RefreshDatabase;

    public function setUp() {
      parent::setUp();
      $this->withoutExceptionHandling();
    }

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

    /** @test  */
    public function invite_manager_via_cli_2()
    {
      Mail::fake();
      InvitationCode::shouldReceive('generate')
        ->andReturn('INVITATIONCODE_123');
      $this->artisan('invite-manager', [
        'email' => 'pepitolospalotes@gmail.com'
      ]);
      $invitation = Invitation::first();
      $this->assertEquals('pepitolospalotes@gmail.com', $invitation->email);
      $this->assertEquals('INVITATIONCODE_123', $invitation->code);
      Mail::assertSent(ManagerInvitationEmail::class, function ($mail) use ($invitation) {
        return $mail->hasTo('pepitolospalotes@gmail.com')
          && $mail->invitation->is($invitation);
      });
    }
}
