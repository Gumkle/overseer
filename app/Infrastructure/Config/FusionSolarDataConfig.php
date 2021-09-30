<?php

namespace App\Infrastructure\Config;

class FusionSolarDataConfig
{
    public function __construct(
        private string $powerReadDateFormat,
        private string $powerReadInterval,
        private string $datesResponsePath,
        private string $powerResponsePath
    ) {}

    public function powerReadDateFormat(): string
    {
        return $this->powerReadDateFormat;
    }

    public function powerReadInterval(): string
    {
        return $this->powerReadInterval;
    }

    public function datesResponsePath(): string
    {
        return $this->datesResponsePath;
    }

    public function powerResponsePath(): string
    {
        return $this->powerResponsePath;
    }
}
