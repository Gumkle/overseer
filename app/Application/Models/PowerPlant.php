<?php

namespace App\Application\Models;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

class PowerPlant
{
    public function __construct(
        private UuidInterface $id,
        private string $producer,
        private string $producerId,
        private string $username,
        private string $password,
        private DateTimeImmutable $installationDate
    ) {}

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function producerId(): string
    {
        return $this->producerId;
    }

    public function producer(): string
    {
        return $this->producer;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function installationDate(): DateTimeImmutable
    {
        return $this->installationDate;
    }
}
