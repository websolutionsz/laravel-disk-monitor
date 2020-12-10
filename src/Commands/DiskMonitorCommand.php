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

        collect(config('disk-monitor.disk_name'))->each(fn(string $diskName) => $this->recordMetrix($diskName));
        $this->comment('All Done!');
    }

    protected function recordMetrix(String $diskName)
    {
        $this->info("Recording metrics for disk `{$diskName}`...");
        $filecount = count(Storage::disk($diskName)->allFiles());
        DiskMonitorEntry::create([
            'disk_name' => $diskName,
            'file_count' => $filecount
        ]);
    }
}
