<?php

namespace App\Infrastructure\Downloaders;

use App\Application\Exceptions\UpdatePowerProductionReadsException;
use App\Application\Models\Enum\Producer;
use App\Application\Power\Downloader\PowerProductionDownloader;
use App\Application\Power\Downloader\PowerProductionDownloaderBuilder;
use App\Infrastructure\Browser\Interfaces\Browser;
use App\Infrastructure\Config\FusionSolarDataConfig;
use App\Infrastructure\Downloaders\Huawei\HuaweiPowerProductionDownloader;
use Closure;
use DateTimeImmutable;

class ConcretePowerProductionDownloaderBuilder implements PowerProductionDownloaderBuilder
{
    private string $producer;
    private DateTimeImmutable $since;
    private DateTimeImmutable $until;
    private int $chunkSize;
    private Closure $chunkOperation;

    public function __construct(
        private Browser $browser,
        private FusionSolarDataConfig $fusionSolarDataConfig
    ) {}

    /**
     * @throws UpdatePowerProductionReadsException
     */
    public function producer(string $producer): PowerProductionDownloaderBuilder
    {
        $this->producer = $producer;
        if (!in_array($producer, Producer::values())) {
            throw new UpdatePowerProductionReadsException("Producer $producer is unknown and therefore can't be downloaded");
        }
        return $this;
    }

    public function since(DateTimeImmutable $since): PowerProductionDownloaderBuilder
    {
        $this->since = $since;
        return $this;
    }

    public function until(DateTimeImmutable $until): PowerProductionDownloaderBuilder
    {
        $this->until = $until;
        return $this;
    }

    public function chunked(Closure $closure, int $chunkSize = 100): PowerProductionDownloaderBuilder
    {
        $this->chunkSize = $chunkSize;
        $this->chunkOperation = $closure;
        return $this;
    }

    public function build(): PowerProductionDownloader
    {
        if ($this->producer === Producer::HUAWEI()->getValue()) {
            return new HuaweiPowerProductionDownloader(
                $this->browser,
                $this->fusionSolarDataConfig,
                $this->since,
                $this->until,
                $this->chunkSize,
                $this->chunkOperation,
            );
        }
    }
}
