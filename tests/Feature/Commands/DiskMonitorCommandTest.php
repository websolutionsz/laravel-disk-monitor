<?php
namespace Websolutionsz\DiskMonitor\Tests\Feature\Commands;

use Illuminate\Support\Facades\Storage;
use Websolutionsz\DiskMonitor\Models\DiskMonitorEntry;
use Websolutionsz\DiskMonitor\Tests\TestCase;

class DiskMonitorCommandTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        Storage::fake('local');
        Storage::fake('anotherDisk');
    }

    /** @test */
    public function check_file_singledisk_records()
    {
        Storage::disk('local')->put('test.txt', 'test');

        $this->artisan('disk-monitor:record-metrics')->assertExitCode(0);

        $this->assertCount(1, DiskMonitorEntry::get());
        $entry = DiskMonitorEntry::last();
        $this->assertEquals(1, $entry->file_count);
    }

    /** @test */
    public function check_file_multipledisk_records()
    {
        config()->set('disk-monitor.disk_name', ['local','anotherDisk']);
        Storage::disk('local')->put('test.txt', 'test');
        Storage::disk('anotherDisk')->put('test1.txt', 'test');

        $this->artisan('disk-monitor:record-metrics')->assertExitCode(0);

        $this->assertCount(2, DiskMonitorEntry::get());

        $entry = DiskMonitorEntry::get();

        $this->assertEquals('local', $entry[0]->disk_name);
        $this->assertEquals('anotherDisk', $entry[1]->disk_name);
        $this->assertEquals(1, $entry[1]->file_count);
        $this->assertEquals(1, $entry[0]->file_count);
    }
}
