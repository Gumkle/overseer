<?php

namespace App\Application\Services;

use App\Application\Power\Downloader\PowerProductionDownloaderBuilder;
use App\Application\Repositories\PowerPlantRepository;
use App\Application\Repositories\PowerProductionRepository;
use DateTimeImmutable;

class UpdatePowerProductionReads
{
    public function __construct(
        private PowerPlantRepository $powerPlantRepository,
        private PowerProductionDownloaderBuilder $powerProductionDownloaderBuilder,
        private PowerProductionRepository $powerProductionRepository
    ) {}

    public function update(): array
    {
        $plants = $this->powerPlantRepository->getAllPlants();

        foreach($plants as $plant) {

            $downloader = $this->powerProductionDownloaderBuilder
                ->buildPowerProductionDownloaderFor($plant);

            $lastDayOfReads = $this->powerProductionRepository
                ->getLastDayOfReads($plant);

            $powerProduction = $downloader
                ->since($lastDayOfReads)
                ->until($this->today())
                ->downloadPowerProduction($plant);

            $this->powerProductionRepository
                ->savePowerProduction($powerProduction);

        }
    }

    private function today()
    {
        return new DateTimeImmutable();
    }
}
