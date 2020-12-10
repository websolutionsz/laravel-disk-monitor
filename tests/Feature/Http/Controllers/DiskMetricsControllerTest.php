<?php

namespace Websolutionsz\DiskMonitor\Tests\Feature\Http\Controllers;

use Websolutionsz\DiskMonitor\Tests\TestCase;

class DiskMetricsControllerTest extends TestCase
{
    /** @test */
    public function test_disk_entries()
    {
        $this->get('disk-monitor')->assertOk();
    }
}
