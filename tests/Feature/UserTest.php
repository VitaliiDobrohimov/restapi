<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Nette\Utils\Random;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testCreate(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);

        $response = $this->actingAs($user)
            ->post('api/users',
                ['name' => $user->name,
                    'email' => $user->email,
                    'password' => $user->password,
                    'pin_code' => $user->pin_code,
                    'role_id' => $user->role_id]);
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $id = rand(1, 3);
        $response = $this->actingAs($user)
            ->put("/api/users/{$id}/update",
                ['name' => $user->name,
                    'email' => $user->email,
                    'password' => $user->password,
                    'pin_code' => $user->pin_code,
                    'role_id' => $user->role_id]);
        $response->assertStatus(200);
    }

    public function testShow(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $id = rand(1, 3);
        $response = $this->actingAs($user)
            ->get("/api/users/{$id}");
        $response->assertStatus(200);
    }


    public function testDestroy(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $id = rand(1, 3);
        $response = $this->actingAs($user)
            ->delete("/api/users/{$id}/delete");
        $response->assertStatus(200);
    }

    public function testIndexOrderBy(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $response = $this->actingAs($user)
            ->get("/api/users",
                ['orderBy'=> $user->name,
                    'sort'=> 'desc']);
        $response->assertStatus(200);
    }

    public function testIndexFind(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $response = $this->actingAs($user)
            ->get("/api/users",
                ['name' => $user->name]);
        $response->assertStatus(200);
    }

}
