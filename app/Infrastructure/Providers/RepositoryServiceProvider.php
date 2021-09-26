<?php

namespace App\Infrastructure\Providers;

use App\Application\Repositories\PowerPlantRepository;
use App\Application\Repositories\PowerProductionRepository;
use App\Infrastructure\Eloquent\Repositories\EloquentPowerPlantRepository;
use App\Infrastructure\Eloquent\Repositories\EloquentPowerProductionRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public $bindings = [
        PowerProductionRepository::class => EloquentPowerProductionRepository::class,
        PowerPlantRepository::class => EloquentPowerPlantRepository::class
    ];

    public function provides(): array
    {
        return [
            PowerPlantRepository::class,
            PowerProductionRepository::class
        ];
    }
}
