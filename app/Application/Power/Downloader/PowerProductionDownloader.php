<?php

namespace App\Application\Power\Downloader;

use App\Application\Models\PowerPlant;

interface PowerProductionDownloader
{
    public function downloadFor(PowerPlant $plant): void;
}
