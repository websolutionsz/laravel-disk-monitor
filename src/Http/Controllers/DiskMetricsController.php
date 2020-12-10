<?php

namespace Websolutionsz\DiskMonitor\Http\Controllers;

use Websolutionsz\DiskMonitor\Models\DiskMonitorEntry;

class DiskMetricsController
{
    public function index(){
        $entries = DiskMonitorEntry::latest()->get();

        return view('disk-monitor::entrie',compact('entries'));
    }
}