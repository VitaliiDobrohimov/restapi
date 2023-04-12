<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'name'=>'superAdmin',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        Role::create([
            'name'=>'Admin',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        Role::create([
            'name'=>'waiter',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        //User::factory(10)->create();
        User::create([
            'name' => 'Vitalii',
            'email' => 'dod300@yandex.ru',
            'email_verified_at' => now(),
            'pin_code' => 1234,
            'password' => bcrypt(12345678),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'Ilia',
            'email' => 'Ilia300@yandex.ru',
            'email_verified_at' => now(),
            'pin_code' => 7777,
            'password' => bcrypt(12345678),
            'role_id' => 2,
        ]);
        User::create([
            'name' => 'Artemii',
            'email' => 'Art300@yandex.ru',
            'email_verified_at' => now(),
            'pin_code' => 1111,
            'password' => bcrypt(12345678),
            'role_id' => 3,
        ]);
        Category::factory(10)->create();
        Dish::factory(10)->create();
        Order::factory(10)->create();




    }
}
