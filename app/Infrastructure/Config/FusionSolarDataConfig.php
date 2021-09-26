<?php

namespace App\Infrastructure\Config;

class FusionSolarDataConfig
{
    public function __construct(
        private string $powerReadDateFormat,
        private string $powerReadInterval
    ) {}

    public function powerReadDateFormat(): string
    {
        return $this->powerReadDateFormat;
    }

    public function powerReadInterval(): string
    {
        return $this->powerReadInterval;
    }
}
