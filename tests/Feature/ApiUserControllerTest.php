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
        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function canListUsers()
    {
        //prepare

        $users = factory(User::class, 3)->create();

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

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
    }

    /**
     * @test
     */
    public function cannotAddUserIfNoNameProvided()
    {
        // prepare

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        // run

        $response = $this->json('POST', '/api/v1/users');

        // assert

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function cannotAddUserIfNotLogged()
    {

        // prepare

        $faker = Factory::create();

        // run

        $response = $this->json('POST', '/api/v1/users', [
            'name' => $name = $faker->word,
        ]);

        // assert

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function canAddAUser()
    {
        // prepare

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $faker = Factory::create();

        // run

        $response = $this->json('POST', '/api/v1/users', [
            'name' => $name = $faker->word,
            'email' => $email = $faker->email,
            'password' => $passwd = $faker->password,
        ]);

        // assert

        $response->assertSuccessful();
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
        ]);

        $response->assertJson([
            'name' => $name,
            'email' => $email
        ]);
    }

    /**
     * @test
     */
    public function canDeleteUser()
    {

        // prepare
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

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
     * @test
     */
    public function cannotDeleteUnexistingUser()
    {

        // prepare
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        // run

        $response = $this->json('DELETE', 'api/v1/users/8888');

        // assert

        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function canEditUser()
    {

        // prepare

        $faker = Factory::create();
        $user = factory(User::class)->create();

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

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
}
