<?php

namespace Websolutionsz\DiskMonitor\Commands;

use Illuminate\Console\Command;

class DiskMonitorCommand extends Command
{
    public $signature = 'laravel-disk-monitor';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
