<?php

namespace App\Application\Models;

use App\Application\Models\Enum\Unit;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

class PowerProduction
{
    public function __construct(
        private UuidInterface     $id,
        private UuidInterface     $plantId,
        private DateTimeImmutable $dateTime,
        private float             $powerValue,
        private Unit              $unit
    ) {}

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function plantId(): UuidInterface
    {
        return $this->plantId;
    }

    public function dateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function powerValue(): float
    {
        return $this->powerValue;
    }

    public function unit(): Unit
    {
        return $this->unit;
    }
}
