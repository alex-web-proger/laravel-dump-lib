<?php

namespace Alexlen\DumpLib\Providers;

use Alexlen\Dump\Console\Commands\DumpBackup;
use Alexlen\Dump\Console\Commands\DumpBackupClear;
use Alexlen\Dump\Console\Commands\DumpExport;
use Alexlen\Dump\Console\Commands\DumpHelp;
use Alexlen\Dump\Console\Commands\DumpImport;
use Alexlen\Dump\Console\Commands\DumpRestore;
use Illuminate\Support\ServiceProvider;

class DumpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/alexlendump.php' => config_path('alexlendump.php'),
        ], 'alexlendump');
    }
}
