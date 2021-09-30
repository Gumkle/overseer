<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Application\Models\PowerPlant;
use App\Application\Models\PowerProduction;
use App\Application\Repositories\PowerProductionRepository;
use DateTimeImmutable;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Webmozart\Assert\Assert;

class EloquentPowerProductionRepository implements PowerProductionRepository
{
    const TABLE_NAME = 'power_production';

    public function __construct(
        private DatabaseManager $database
    ) {}

    /** @param PowerProduction[] $powerProduction */
    public function savePowerProduction(array $powerProduction): void
    {
        Assert::allIsInstanceOf($powerProduction, PowerProduction::class);

        $powerProduction = array_map(function($item) {
            return [
                'id' => $item->id(),
                'measured_at' => $item->dateTime(),
                'unit' => $item->unit(),
                'power_plant_id' => $item->plantId(),
                'power' => $item->powerValue()
            ];
        }, $powerProduction);

        DB::table('power_production')->upsert($powerProduction, ['id', 'measured_at']);
    }

    public function getLastReadTimeForPlant(PowerPlant $plant): ?DateTimeImmutable
    {
        $result = $this->database->table(self::TABLE_NAME)
            ->where('power_plant_id', $plant->id())
            ->max('measured_at');
        if(!isset($result)) {
            return $plant->installationDate();
        }

        return DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $result);
    }
}
