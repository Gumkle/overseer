<?php

namespace App\Application\Power\Downloader;

use App\Application\Models\PowerPlant;

interface PowerProductionDownloaderBuilder
{
    public function buildPowerProductionDownloaderFor(PowerPlant $plant): PowerProductionDownloader;
}
