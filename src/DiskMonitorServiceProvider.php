<?php

namespace Websolutionsz\DiskMonitor;

use Illuminate\Support\ServiceProvider;
use Websolutionsz\DiskMonitor\Commands\DiskMonitorCommand;

class DiskMonitorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/disk-monitor.php' => config_path('disk-monitor.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/disk-monitor'),
            ], 'views');

            $migrationFileName = 'create_disk_monitor_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                DiskMonitorCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'disk-monitor');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/disk-monitor.php', 'disk-monitor');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
