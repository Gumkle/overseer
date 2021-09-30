<?php

namespace App\Application\Services;

use App\Application\Power\Downloader\PowerProductionDownloaderBuilder;
use App\Application\Repositories\PowerPlantRepository;
use App\Application\Repositories\PowerProductionRepository;
use DateTimeImmutable;

class UpdatePowerProductionReads
{
    private const DOWNLOAD_CHUNK_SIZE = 1000;

    public function __construct(
        private PowerPlantRepository $powerPlantRepository,
        private PowerProductionDownloaderBuilder $powerProductionDownloaderBuilder,
        private PowerProductionRepository $powerProductionRepository
    ) {}

    public function handle(): void
    {
        $plants = $this->powerPlantRepository->getAllPlants();

        foreach($plants as $plant) {

            $lastReadsTime = $this->powerProductionRepository
                ->getLastReadTimeForPlant($plant);

            $downloader = $this->powerProductionDownloaderBuilder
                ->producer($plant->producer())
                ->since($lastReadsTime)
                ->until($this->today())
                ->chunked(
                    function (array $chunk) {
                        $this->powerProductionRepository
                            ->savePowerProduction($chunk);
                        echo "Just saved one chunk to db";
                    },
                    self::DOWNLOAD_CHUNK_SIZE
                )
                ->build();

            $downloader->downloadFor($plant);
        }
    }

    private function today(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
