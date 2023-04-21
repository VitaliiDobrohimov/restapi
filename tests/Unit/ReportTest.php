<?php

namespace Tests\Unit;

use App\Models\Report;
//use App\Models\ResetPin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;


class ReportTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    use DatabaseMigrations;
    public function testReports(): void
    {
        $before = Report::all()->count();
        Artisan::call('report:create');
        $this->assertTrue($before < Report::all()->count());
    }


}
