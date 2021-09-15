<?php

namespace App\Application\Repositories;

use App\Application\Models\PowerPlant;
use App\Application\Models\PowerProduction;
use DateTimeImmutable;

interface PowerProductionRepository
{
    public function getLastDayOfReads(PowerPlant $plant): DateTimeImmutable;

    /** @param PowerProduction[] $powerProduction */
    public function savePowerProduction(array $powerProduction);
}
