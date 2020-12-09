<?php

namespace Websolutionsz\DiskMonitor\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Websolutionsz\DiskMonitor\Models\DiskMonitorEntry;

class DiskMonitorCommand extends Command
{
    public $signature = 'disk-monitor:record-metrics';

    public $description = 'Record Metrics of disk';

    public function handle()
    {
        $this->comment('Recording Metrics...');

        $diskName = config('disk-monitor.disk_name');
        $filecount = count(Storage::disk($diskName)->allFiles());
        DiskMonitorEntry::create([
            'disk_name' => config('disk-monitor.disk_name'),
            'file_count' => $filecount,
        ]);

        $this->comment('All Done!');
    }
}
