<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        initialize_task_permissions();
//        $this->withoutExceptionHandling();
    }

    public function loginAsAuthorizedUser()
    {
        $user = factory(User::class)->create();
        $user->assignRole('user-manager');
        $this->actingAs($user, 'api');

        return $user;
    }

    /**
     * ListUsers API.
     *
     * @test
     */
    public function list_users()
    {
        //prepare

        $users = factory(User::class, 3)->create();

        $this->loginAsAuthorizedUser();

        // run
        $response = $this->json('GET', 'api/v1/users');

        // assert

        $response->assertSuccessful();

        $response->assertJsonStructure([[
            'id',
            'name',
            'created_at',
            'updated_at',
        ]]);

        foreach ($users as $user) {
            $response->assertJsonFragment([
                'id'   => $user->id,
                'name' => $user->name,
            ]);
        }
    }

    /**
     * ShowUser API.
     *
     * @test
     */
    public function show_user()
    {
        $this->loginAsAuthorizedUser();

        $user = factory(User::class)->create();

        $response = $this->json('GET', 'api/v1/users/'.$user->id);

        $response->assertSuccessful();

        $response->assertJsonFragment([
            'id'   => $user->id,
            'name' => $user->name,
        ]);
    }

    /**
     * ShowUser API.
     *
     * @test
     */
    public function show_user_api_fail_if_user_not_found()
    {
        $this->loginAsAuthorizedUser();

        $response = $this->json('GET', 'api/v1/users/2');

        $response->assertStatus(404);
    }

    /**
     * StoreUser API.
     *
     * @test
     */
    public function store_user()
    {
        // prepare

        $this->loginAsAuthorizedUser();

        $faker = Factory::create();

        // run

        $response = $this->json('POST', '/api/v1/users', [
            'name'     => $name = $faker->word,
            'email'    => $email = $faker->email,
            'password' => $passwd = $faker->password,
        ]);

        // assert

        $response->assertSuccessful();
        $this->assertDatabaseHas('users', [
            'name'  => $name,
            'email' => $email,
        ]);

        $response->assertJson([
            'name'  => $name,
            'email' => $email,
        ]);
    }

    /**
     * StoreUser API.
     *
     * @test
     */
    public function store_user_api_fail_if_no_name_provided()
    {
        // prepare

        $this->loginAsAuthorizedUser();

        // run

        $response = $this->json('POST', '/api/v1/users');

        // assert

        $response->assertStatus(422);
    }

    /**
     * DeleteUser API.
     *
     * @test
     */
    public function delete_user()
    {

        // prepare
        $this->loginAsAuthorizedUser();

        $user = factory(User::class)->create();

        // run

        $response = $this->json('DELETE', 'api/v1/users/'.$user->id);

        // assert

        $response->assertSuccessful();
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    /**
     * DeleteUser API.
     *
     * @test
     */
    public function delete_user_api_fail_if_user_not_found()
    {

        // prepare
        $this->loginAsAuthorizedUser();

        // run

        $response = $this->json('DELETE', 'api/v1/users/8888');

        // assert

        $response->assertStatus(404);
    }

    /**
     * EditUser API.
     *
     * @test
     */
    public function edit_user()
    {

        // prepare

        $this->loginAsAuthorizedUser();

        $faker = Factory::create();

        $user = factory(User::class)->create();

        // run

        $response = $this->json('PUT', 'api/v1/users/'.$user->id, [
            'name' => $newName = $faker->word,
        ]);

        // assert
        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'id'   => $user->id,
            'name' => $newName,
        ]);

        $this->assertDatabaseMissing('users', [
            'id'   => $user->id,
            'name' => $user->name,
        ]);
    }

    /**
     * EditUser API.
     *
     * @test
     */
    public function edit_user_api_fail_if_user_not_found()
    {
        $this->loginAsAuthorizedUser();

        $response = $this->json('PUT', 'api/v1/users/2', [
            'name' => 'ProvaEdit',
        ]);

        $response->assertStatus(404);
    }
}
