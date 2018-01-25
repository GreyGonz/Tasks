<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Support\Facades\Artisan;

use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;

class LaravelPassportPasswordGrantProxyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
        initialize_task_permissions();
        Artisan::call('passport:install');
        $this->withoutExceptionHandling();
    }

    /**
     * Can proxy password grant.
     * @test
     */
    public function can_proxy_password_grant()
    {
        $user = factory(User::class)->create(
            ['password' => 'secret']
        );
        $response = $this->json('POST', 'http://tasks.test/api/v1/proxy/oauth/token', [
            'username' => $user->email,
            'password' => 'secret',
        ]);
        $response->assertSuccessful();
    }
}
