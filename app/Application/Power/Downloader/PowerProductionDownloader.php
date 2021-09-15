<?php

namespace App\Application\Power\Downloader;

use App\Application\Models\PowerPlant;
use App\Application\Models\PowerProduction;
use DateTimeImmutable;

interface PowerProductionDownloader
{

    public function since(DateTimeImmutable $lastDayOfReads): PowerProductionDownloader;

    public function until(DateTimeImmutable $today): PowerProductionDownloader;

    /** @return PowerProduction[] */
    public function downloadPowerProduction(PowerPlant $plant): array;
}
