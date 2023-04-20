<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Nette\Utils\Random;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testCreate(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $order = Order::factory()->make();
        $response = $this->actingAs($user)
            ->post('api/orders',
                ['number' => $order->number,
                    'waiter_id' => $order->waiter_id]);

        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $order = Order::factory()->make();
        $id = rand(1, 10);
        $response = $this->actingAs($user)
            ->put("/api/orders/{$id}/update",
                ['number' => $order->number,
                    'waiter_id' => $order->waiter_id,
                    'is_closed' => $order->is_closed,]);
        $response->assertStatus(200);
    }

    public function testShow(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $id = rand(1, 10);
        $response = $this->actingAs($user)
            ->get("/api/orders/{$id}");
        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $id = rand(1, 10);
        $response = $this->actingAs($user)
            ->get("/api/orders/{$id}/edit");
        $response->assertStatus(200);
    }
    public function testDestroy(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $id = rand(1, 10);
        $response = $this->actingAs($user)
            ->delete("/api/orders/{$id}/delete");
        $response->assertStatus(200);
    }

    public function testIndexOrderBy(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $order = Order::factory()->make();
        $response = $this->actingAs($user)
            ->get("/api/orders",
                ['orderBy'=> $order->total_cost,
                    'sort'=> 'desc']);
        $response->assertStatus(200);
    }



    public function testAddDish(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 3]);
        $order = Order::factory()->make();
        $id_dish = rand(1,10);
        $id_order = rand(1,10);
        $response = $this->actingAs($user)
            ->post("api/orders/{$id_dish}/{$id_order}", ['count' => rand(1,5)]);

        $response->assertStatus(200);
        $order = Order::factory()->create(['is_closed'=> true]);
        $response = $this->actingAs($user)
            ->post("api/orders/{$id_dish}/{$order->id}", ['count' => rand(1,5)]);

        $response->assertStatus(502);
        $id_dish = 22;
        $response = $this->actingAs($user)
            ->post("api/orders/{$id_dish}/{$id_order}", ['count' => rand(1,5)]);
        $response->assertStatus(501);

    }

    public function testDelDish(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 3]);
        $id_dish = 5;
        $id_order =5;
        $response = $this->actingAs($user)
            ->post("api/orders/{$id_dish}/{$id_order}", ['count' => 2]);
        $response->assertStatus(200);

        $response = $this->actingAs($user)
            ->put("api/orders/{$id_dish}/{$id_order}/delete", ['count'=>1]);
        $response->assertStatus(200);


        $order = Order::factory()->create(['is_closed'=> true]);
        $response = $this->actingAs($user)
            ->put("api/orders/{$id_dish}/{$order->id}/delete", ['count' => rand(1,5)]);
        $response->assertStatus(503);


        $id_order = rand(1,10);
        $id_dish = rand(10,20);
        $response = $this->actingAs($user)
            ->put("api/orders/{$id_dish}/{$id_order}/delete", ['count' => rand(1,5)]);
        $response->assertStatus(501);

    }
    public function testCloseOrder(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 3]);
        $order = Order::factory()->create();
        $response = $this->actingAs($user)
            ->put("api/orders/{$order->id}/close");
        $response->assertStatus(200);

    }
    public function testIndexFind(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $order = Order::factory()->make();
        $response = $this->actingAs($user)
            ->get("/api/orders",
                ['total_cost' => $order->total_cost]);
        $response->assertStatus(200);
    }

}
