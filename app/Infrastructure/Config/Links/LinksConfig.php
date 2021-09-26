<?php

namespace App\Infrastructure\Config\Links;

use App\Infrastructure\Config\Links\HuaweiLinksConfig;

class LinksConfig
{
    public function __construct(
        private HuaweiLinksConfig $huaweiLinksConfig
    ) {}

    public function huawei(): HuaweiLinksConfig
    {
        return $this->huaweiLinksConfig;
    }
}
