<?php

namespace App\Infrastructure\Providers;

use App\Infrastructure\Config\BrowserConfig;
use App\Infrastructure\Config\Links\HuaweiLinksConfig;
use App\Infrastructure\Config\Links\LinksConfig;
use App\Infrastructure\Config\Selectors\HuaweiSelectorsConfig;
use App\Infrastructure\Config\Selectors\SelectorsConfig;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class BrowserConfigProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->bind(HuaweiSelectorsConfig::class, function() {
            return new HuaweiSelectorsConfig(
                config('browser.selectors.huawei.loginInput'),
                config('browser.selectors.huawei.passwordInput'),
                config('browser.selectors.huawei.loginSubmitButton'),
                config('browser.selectors.huawei.restResponseContent')
            );
        });

        $this->app->bind(HuaweiLinksConfig::class, function () {
            return new HuaweiLinksConfig(
                config('browser.links.huawei.mainPage'),
                config('browser.links.huawei.dataPage'),
            );
        });

        $this->app->bind(BrowserConfig::class, function (Application $app) {
            return new BrowserConfig(
                config('browser.headless'),
                $app->make(LinksConfig::class),
                $app->make(SelectorsConfig::class),
                config('browser.executable')
            );
        });
    }

    public function provides()
    {
        return [
            HuaweiLinksConfig::class,
            HuaweiSelectorsConfig::class,
            BrowserConfig::class
        ];
    }
}
