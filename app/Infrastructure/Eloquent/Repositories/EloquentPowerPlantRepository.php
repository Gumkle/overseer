<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Application\Models\PowerPlant;
use App\Application\Repositories\PowerPlantRepository;
use DateTimeImmutable;
use Illuminate\Database\DatabaseManager;
use Ramsey\Uuid\Uuid;

class EloquentPowerPlantRepository implements PowerPlantRepository
{
    private const TABLE_NAME = 'power_plants';

    public function __construct(
        private DatabaseManager $database
    ) {}

    /** @return PowerPlant[] */
    public function getAllPlants(): array
    {
        $results = $this->database->table(self::TABLE_NAME)
            ->select([
                'id',
                'producer',
                'producer_id',
                'username',
                'password',
                'installation_date'
            ])
            ->get();
        return $results->transform(function ($result) {
            return new PowerPlant(
                Uuid::fromString($result->id),
                $result->producer,
                $result->producer_id,
                $result->username,
                $result->password,
                DateTimeImmutable::createFromFormat('Y-m-d', $result->installation_date)
            );
        })->toArray();
    }
}
