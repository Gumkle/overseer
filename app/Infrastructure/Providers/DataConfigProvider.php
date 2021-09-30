<?php

namespace App\Infrastructure\Providers;

use App\Infrastructure\Config\FusionSolarDataConfig;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DataConfigProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->bind(FusionSolarDataConfig::class, function () {
            return new FusionSolarDataConfig(
                config('dataStructure.huaweiFusionSolar.powerReadDateFormat'),
                config('dataStructure.huaweiFusionSolar.powerReadInterval'),
                config('dataStructure.huaweiFusionSolar.datesResponsePath'),
                config('dataStructure.huaweiFusionSolar.powerResponsePath'),
            );
        });
    }

    public function provides()
    {
        return [
            FusionSolarDataConfig::class
        ];
    }
}
