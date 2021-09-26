<?php

namespace App\Infrastructure\Providers;

use App\Infrastructure\Browser\GoogleChrome\ChromeBrowser;
use App\Infrastructure\Browser\Interfaces\Browser;
use App\Infrastructure\Config\BrowserConfig;
use App\Infrastructure\Cryptography\PasswordEncrypter;
use HeadlessChromium\BrowserFactory;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class BrowserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->bind(Browser::class, function(Application $app) {
            /** @var BrowserConfig $config */
            $config = $app->make(BrowserConfig::class);
            $browserFactory = new BrowserFactory(
                $config->executable()
            );
            $libraryBrowser = $browserFactory->createBrowser([
                'headless' => $config->isHeadless(),

            ]);
            return new ChromeBrowser(
                $libraryBrowser,
                $config,
                $this->app->make(PasswordEncrypter::class)
            );
        });
    }

    public function provides(): array
    {
        return [
            Browser::class
        ];
    }
}
