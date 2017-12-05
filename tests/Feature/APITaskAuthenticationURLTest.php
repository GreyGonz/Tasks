<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use View;

class APITaskAuthenticationURLTest extends TestCase
{

    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        initialize_task_permissions();
        factory(Task::class)->create();
        $user = factory(User::class)->create();
//        $user->assignRole('task-manager');
        $this->actingAs($user, 'api');
//        View::share('user', $user);

//        $this->withoutExceptionHandling();


    }

    public function authorizatedURLs()
    {
        return [
            ['get', 'api/tasks'],
            ['post', 'api/tasks'],
            ['delete', 'api/tasks/1'],
            ['put', 'api/tasks/1'],
            ['get', 'api/v1/users'],
            ['post', 'api/v1/users'],
            ['delete', 'api/v1/users/1'],
            ['put', 'api/v1/users/1'],
        ];
    }

    /**
     * URI authorized user
     *
     * @test
     * @dataProvider authorizatedURLs
     */
    public function uri_authorized_user($method, $uri)
    {
        $response = $this->json($method,$uri);
        $response->assertStatus(403);
    }
}
