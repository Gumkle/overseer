<?php

namespace App\Infrastructure\Config\Links;

use DateTimeImmutable;

class HuaweiLinksConfig
{
    public function __construct(
        private string $mainPage,
        private string $dataPage
    )
    {}

    public function mainPage(): string
    {
        return $this->mainPage;
    }

    public function dataPage(DateTimeImmutable $time, string $objectId): string
    {
        $date = $time->format("Y-m-d\n");
        $timestamp = strtotime($date)*1000;
        return sprintf($this->dataPage, $objectId, $timestamp);
    }
}
