<?php
namespace Websolutionsz\DiskMonitor\Tests\Feature\Commands;
use Illuminate\Support\Facades\Storage;
use Websolutionsz\DiskMonitor\Tests\TestCase;
use Websolutionsz\DiskMonitor\Models\DiskMonitorEntry;

class DiskMonitorCommandTest extends TestCase
{
    public function setUp() : void{
        parent::setUp();

        Storage::fake('local');
    }

    /** @test */
    public function check_file_disk_records()
    {
        Storage::disk('local')->put('test.txt','test');

        $this->artisan('disk-monitor:record-metrics')->assertExitCode(0);

        $this->assertCount(1,DiskMonitorEntry::get());
    }
}