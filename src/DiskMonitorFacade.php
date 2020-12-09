<?php

namespace Websolutionsz\DiskMonitor;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Websolutionsz\DiskMonitor\DiskMonitor
 */
class DiskMonitorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-disk-monitor';
    }
}
