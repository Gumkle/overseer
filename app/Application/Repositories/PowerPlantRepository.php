<?php

namespace App\Application\Repositories;

use App\Application\Models\PowerPlant;

interface PowerPlantRepository
{
    /** @return PowerPlant[] */
    public function getAllPlants(): array;
}
