<?php

namespace Tests\Feature;

use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testLoginSuperAdmin():void
    {
        $user = User::factory()->create(['password'=>bcrypt($password = '12345678'),'role_id' => 1]);
        $response = $this->post('api/login',
            ['email'=>$user['email'],
             'password'=> $password]);
        $response->assertStatus(200);
        $response->assertJsonPath('data.access_token',csrf_token());

    }
    public function testLoginAdmin():void
    {
        $user = User::factory()->create(['password'=>bcrypt($password = '12345678'),'role_id' => 2]);
        $response = $this->post('api/login',
            ['email'=>$user['email'],
                'password'=> $password]);
        $response->assertStatus(200);
        $response->assertJsonPath('data.access_token',csrf_token());
    }

    public function testLoginWaiter():void
    {
        $user = User::factory()->create(['password'=>bcrypt($password = '12345678'),'role_id' => 3]);
        $response = $this->post('api/login',
            ['email'=>$user['email'],
                'password'=> $password]);
        $response->assertStatus(200);
        $response->assertJsonPath('data.access_token',csrf_token());
    }
    public function testLogout():void
    {
        $user = User::factory()->create(['password'=>bcrypt($password = '12345678'),'role_id' => 1]);
        $response = $this->actingAs($user)
            ->post('api/logout');

        $response->assertStatus(200);

    }
    public function testRegister():void
    {
        $user = User::factory()->make(['password'=>bcrypt($password = '12345678'),'role_id' => 1,'pin_code'=>5555]);
        $response = $this->post('api/register',
            ['name' =>$user->name,
            'email'=>$user->email,
            'password'=>$user->password,
            'password_confirmation'=>$user->password,
            'pin_code'=>$user->pin_code,
            'role_id'=>$user->role_id]);
        $response->assertStatus(200);
        $response->assertJsonPath('data.access_token',csrf_token());

    }
    public function testSentEmail():void
    {
        $user = User::factory()->make(['password'=>bcrypt($password = '12345678'),'role_id' => 1,'pin_code'=>5555]);
        $response = $this->post('api/forgot-password',
            ['email'=>$user->email]);
        $response->assertStatus(200);

    }
    public function testpincodeConfirmation(): void
    {
        $user = User::factory()->make(['role_id' => 1]);
        $reset_password = ResetPassword::factory()->create();
        $response = $this->post('api/pincode-confirmation',
            ['pin_code'=>$reset_password->pin_code]);
        $response->assertStatus(200);
    }


}
