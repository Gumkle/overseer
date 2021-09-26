<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Application\Models\PowerPlant;
use App\Application\Repositories\PowerProductionRepository;
use DateTimeImmutable;
use Illuminate\Database\DatabaseManager;

class EloquentPowerProductionRepository implements PowerProductionRepository
{
    const TABLE_NAME = 'power_production';

    public function __construct(
        private DatabaseManager $database
    ) {}

    public function savePowerProduction(array $powerProduction): void
    {
        var_dump("save power production");
        die();
    }

    public function getLastReadTimeForPlant(PowerPlant $plant): ?DateTimeImmutable
    {
        $result = $this->database->table(self::TABLE_NAME)
            ->where('power_plant_id', $plant->id())
            ->max('measured_at');
        if(!isset($result)) {
            return $plant->installationDate();
        }
        return DateTimeImmutable::createFromFormat('Y-m-d h:i:s', $result);
    }
}
