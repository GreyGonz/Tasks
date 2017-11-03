<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreTask()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->post('/task', [ 'name' => 'Comprar llet']);
        $response->assertSuccessful();
        $this->assertDatabaseHas('tasks', [
            'name' => 'Comprar llet'
        ]);
    }
}
