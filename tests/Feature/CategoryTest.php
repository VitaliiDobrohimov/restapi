<?php

namespace Tests\Feature;

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

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testCreate(): void
    {

        Storage::fake('local');
        $file = File::create('image.jpg',50);
        $category = Category::factory()->make();
        $response = $this->actingAs(User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]))
            ->post('api/categories',
                ['name' => $category->name,
                    'image' => $file]);
        $category = Category::all()->last();
        $this->assertDatabaseHas('categories',[
            'name'=> $category->name,
        ]);
        Storage::disk('local')->assertExists($category->image);
        $response->assertStatus(200);
    }
    public function testUpdate(): void
    {

        Storage::fake('local');
        $file = File::create('image.jpg',50);
        $category = Category::factory()->make();
        $id = rand(1,10);
        $response = $this->actingAs(User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]))
            ->put("api/categories/{$id}/update",
                ['name' => $category->name,
                    'image' => $file]);
        $category = Category::find($id);
        $this->assertDatabaseHas('categories',[
            'name'=> $category->name,
        ]);
        Storage::disk('local')->assertExists($category->image);
        $response->assertStatus(200);

        $response = $this->actingAs(User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 3]))
            ->put("api/categories/{$id}/update",
                ['name' => $category->name,
                    'image' => $file]);
        $response->assertStatus(403);
        $response = $this->actingAs(User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 3]))
            ->put("api/categories/{$id}/update",
                ['name' => $category->name,
                    'image' => 'file']);
        $response->assertStatus(302);

    }
    public function testShow(): void
    {

        $id = rand(1, 10);
        $response = $this->actingAs(User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]))
            ->get("api/categories/{$id}");

        $response->assertStatus(200);
    }


    public function testIndexOrderBy(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $category = Category::factory()->create();
        $response = $this->actingAs($user)
            ->get("/api/categories",
                ['orderBy'=> $category->name,
                    'sort'=> 'desc']);
        $response->assertStatus(200);
    }
    public function testDestroy(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $id = rand(1,10);
        $response = $this->actingAs($user)
            ->delete("api/categories/{$id}/delete");
        $this->assertDatabaseMissing('categories',[
            'id'=> $id,
        ]);
        $response->assertStatus(200);
    }


    public function testIndexFind(): void
    {
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $category = Category::factory()->create();
        $response = $this->actingAs($user)

            ->get("/api/categories",
                ['name' => $category->name]);
        $response->assertStatus(200);

    }


}
