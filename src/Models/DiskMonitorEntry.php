<?php
namespace Websolutionsz\DiskMonitor\Models;

use Illuminate\Database\Eloquent\Model;

class DiskMonitorEntry extends Model
{
    public $guarded = [];

    public static function last()
    {
        return static::orderByDesc('id')->first();
    }
}
