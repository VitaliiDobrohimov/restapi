<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Nette\Utils\Random;
use Tests\TestCase;

class ReportTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;



    public function testShow(): void
    {
        $report  = Report::factory()->create();
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $response = $this->actingAs($user)
            ->get("/api/reports/{$report->id}");
        $response->assertStatus(200);
    }

    public function testIndexOrderBy(): void
    {
        $report  = Report::factory()->create();
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $response = $this->actingAs($user)
            ->get("/api/reports",
                ['orderBy'=> $report->total_cost,
                    'sort'=> 'desc']);
        $response->assertStatus(200);
    }

    public function testIndexFind(): void
    {
        $report  = Report::factory()->create();
        $user = User::factory()->make(['password' => bcrypt($password = '12345678'), 'role_id' => 1]);
        $response = $this->actingAs($user)
            ->get("/api/reports",
                ['total_orders' => $report->total_orders]);
        $response->assertStatus(200);
    }

}
