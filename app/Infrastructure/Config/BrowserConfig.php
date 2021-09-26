<?php

namespace App\Infrastructure\Config;

use App\Infrastructure\Config\Links\LinksConfig;
use App\Infrastructure\Config\Selectors\SelectorsConfig;

class BrowserConfig
{
    public function __construct(
        private bool $headless,
        private LinksConfig $linksConfig,
        private SelectorsConfig $selectorsConfig,
        private string $executable
    ) {}

    public function selectors(): SelectorsConfig
    {
        return $this->selectorsConfig;
    }

    public function isHeadless(): bool
    {
        return $this->headless;
    }

    public function links(): LinksConfig
    {
        return $this->linksConfig;
    }

    public function executable(): string
    {
        return $this->executable;
    }
}
