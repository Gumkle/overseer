<?php

namespace App\Infrastructure\Providers;

use App\Application\Power\Downloader\PowerProductionDownloaderBuilder;
use App\Infrastructure\Downloaders\ConcretePowerProductionDownloaderBuilder;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DownloaderServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public $bindings = [
        PowerProductionDownloaderBuilder::class => ConcretePowerProductionDownloaderBuilder::class
    ];

    public function provides()
    {
        return [
            PowerProductionDownloaderBuilder::class
        ];
    }
}
