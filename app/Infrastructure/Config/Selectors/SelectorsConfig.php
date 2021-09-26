<?php

namespace App\Infrastructure\Config\Selectors;

class SelectorsConfig
{
    public function __construct(
        private HuaweiSelectorsConfig $huaweiSelectors
    ) {}

    public function huawei(): HuaweiSelectorsConfig
    {
        return $this->huaweiSelectors;
    }
}
