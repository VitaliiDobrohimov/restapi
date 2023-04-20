<?php

namespace Tests\Feature;

use App\Models\Dish;
use Illuminate\Http\Testing\File;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Random;
use Tests\TestCase;

class DishTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testCreate(): void
    {
        Storage::fake('local');
        $file = File::create('image.jpg',50);
        $dish = Dish::factory()->make();
        $response = $this->actingAs(User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]))
            ->post('api/dishes',  [
                'name' => $dish->name,
                'image' => $file,
                'composition' => $dish->composition,
                'calories' => $dish->calories,
                'cost' => $dish->cost,
                'category_id' => $dish->category_id,
                ]);;
        $dish = Dish::all()->last();
        $this->assertDatabaseHas('dishes',[
            'name'=> $dish->name,
        ]);
        Storage::disk('local')->assertExists($dish->image);
        $response->assertStatus(200);
    }
   public function testUpdate(): void
    {

        Storage::fake('local');
        $file = File::create('image.jpg',50);
        $dish = Dish::factory()->make();
        $id = rand(1,10);
        $response = $this->actingAs(User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]))
            ->put("api/dishes/{$id}/update",  [
                'name' => $dish->name,
                'image' => $file,
                'composition' => $dish->composition,
                'calories' => $dish->calories,
                'cost' => $dish->cost,
                'category_id' => $dish->category_id,
            ]);;
        $dish = Dish::find($id);
        Storage::disk('local')->assertExists($dish->image);
        $response->assertStatus(200);

        $response = $this->actingAs(User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 3]))
            ->put("api/dishes/{$id}/update",
                ['name' => $dish->name,
                    'image' => $file]);
        $response->assertStatus(403);
        $response = $this->actingAs(User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 3]))
            ->put("api/dishes/{$id}/update",
                ['name' => $dish->name,
                    'image' => 'file']);
        $response->assertStatus(302);

    }
    public function testShow(): void
    {

        $id = rand(1, 10);
        $response = $this->actingAs(User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]))
            ->get("api/dishes/{$id}");

        $response->assertStatus(200);
    }
    public function testIndexOrderBy(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $dish = Dish::factory()->create();
        $response = $this->actingAs($user)
            ->get("/api/dishes",
                ['orderBy'=> $dish->name,
                    'sort'=> 'desc']);
        $response->assertStatus(200);
    }
    public function testEdit(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $id = rand(1, 10);
        $response = $this->actingAs($user)
            ->get("api/dishes/{$id}/edit");

        $response->assertStatus(200);
    }
    public function testDestroy(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $id = rand(1,10);
        $response = $this->actingAs($user)
            ->delete("api/dishes/{$id}/delete");
        $this->assertDatabaseMissing('dishes',[
            'id'=> $id,
        ]);
        $response->assertStatus(200);

    }


    public function testIndexFind(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $dish = Dish::factory()->create();
        $response = $this->actingAs($user)
            ->get("/api/categories",
                ['name' => $dish->name]);
        $response->assertStatus(200);

    }


}
