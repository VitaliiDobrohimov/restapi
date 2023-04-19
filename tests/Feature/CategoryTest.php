<?php

namespace Tests\Feature;

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
        $category = Category::factory()->make();
        $response = $this->actingAs(User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]))
            ->post('api/category',
                ['name' => $category->name,
                    'image' => UploadedFile::fake()->image('avatar.jpg'),]);
        $response->assertStatus(200);
        Storage::disk('avatars')->assertExists('avatar.jpg');
    }

}
