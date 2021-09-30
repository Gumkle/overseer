<?php

namespace App\Infrastructure\Browser\Interfaces;

use App\Infrastructure\Downloaders\DataSourceResponse;
use DateTimeImmutable;

interface HuaweiPage extends Page
{
    public function login(): void;

    public function openDataSourceWithTimeSince(DateTimeImmutable $currentTime): DataSourceResponse;
}
