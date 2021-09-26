<?php

namespace App\Infrastructure\Browser\GoogleChrome;

use App\Application\Models\PowerPlant;
use App\Infrastructure\Browser\Interfaces\Browser;
use App\Infrastructure\Browser\Interfaces\HuaweiPage;
use App\Infrastructure\Config\BrowserConfig;
use App\Infrastructure\Cryptography\PasswordEncrypter;
use HeadlessChromium\Browser as LibraryBrowser;

class ChromeBrowser implements Browser
{
    public function __construct(
        private LibraryBrowser $browser,
        private BrowserConfig $config,
        private PasswordEncrypter $encrypter
    )
    {}

    public function openHuaweiPage(PowerPlant $plant): HuaweiPage
    {
        $page = $this->browser->createPage();
        $page->navigate($this->config->links()->huawei()->mainPage())->waitForNavigation();
        return new ChromeHuaweiPage(
            $page,
            $this->config,
            $this->encrypter,
            $plant
        );
    }
}
