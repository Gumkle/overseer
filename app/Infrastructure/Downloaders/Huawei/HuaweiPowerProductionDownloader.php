<?php

namespace App\Infrastructure\Downloaders\Huawei;

use App\Application\Exceptions\UpdatePowerProductionReadsException;
use App\Application\Models\Enum\Unit;
use App\Application\Models\PowerPlant;
use App\Application\Models\PowerProduction;
use App\Application\Power\Downloader\PowerProductionDownloader;
use App\Infrastructure\Browser\Interfaces\Browser;
use App\Infrastructure\Config\FusionSolarDataConfig;
use App\Infrastructure\Downloaders\DataSourceResponse;
use Closure;
use DateInterval;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class HuaweiPowerProductionDownloader implements PowerProductionDownloader
{
    private array $currentChunk = [];

    public function __construct(
        private Browser               $browser,
        private FusionSolarDataConfig $fusionSolarDataConfig,
        private DateTimeImmutable     $since,
        private DateTimeImmutable     $until,
        private int                   $maxChunkSize,
        private Closure               $chunkCallback
    )
    {
    }

    public function downloadFor(PowerPlant $plant): void
    {
        $page = $this->browser->openHuaweiPage($plant);
        $page->login();
        $currentTime = $this->since;

        while ($this->until->getTimestamp() - $currentTime->getTimestamp() > 0) {
            $dataSourceResponse = $page->openDataSourceWithTimeSince($currentTime);
            $powerProduction = $this->extractPowerProductionData($dataSourceResponse, $plant);
            $this->fillChunkWith($powerProduction);
            $currentTime = $currentTime->add(DateInterval::createFromDateString(
                $this->fusionSolarDataConfig->powerReadInterval()
            ));
        }
        $this->flushCurrentChunk();
    }

    /** @return PowerProduction[] */
    private function extractPowerProductionData(DataSourceResponse $dataSourceResponse, PowerPlant $plant): array
    {
        $dates = $dataSourceResponse->arrayFromPath(
            $this->fusionSolarDataConfig->datesResponsePath()
        );
        $powers = $dataSourceResponse->arrayFromPath(
            $this->fusionSolarDataConfig->powerResponsePath()
        );
        $result = [];
        foreach ($dates as $key => $date) {
            $power = is_numeric($powers[$key]) ? $powers[$key] : 0.0;

            $refinedDate = DateTimeImmutable::createFromFormat(
                $this->fusionSolarDataConfig->powerReadDateFormat(),
                $date
            );

            if ($refinedDate === false) {
                throw new UpdatePowerProductionReadsException(
                    "Failed to read date from data source. Probably date format has changed."
                );
            }

            $powerProduction = new PowerProduction(
                Uuid::uuid4(),
                $plant->id(),
                $refinedDate,
                $power,
                Unit::KWH()
            );
            $result[] = $powerProduction;
        }
        return $result;
    }

    /** @param PowerProduction[] */
    private function fillChunkWith(array $powerProduction): void
    {
        $spacesLeft = $this->maxChunkSize - count($this->currentChunk);
        $baseReads = array_slice($powerProduction, 0, $spacesLeft);
        $extraReads = array_slice($powerProduction, $spacesLeft);

        $this->currentChunk = array_merge($this->currentChunk, $baseReads);

        if (count($this->currentChunk) === $this->maxChunkSize) {
            $this->flushCurrentChunk();
            $this->fillChunkWith($extraReads);
        }
    }

    private function flushCurrentChunk(): void
    {
        ($this->chunkCallback)($this->currentChunk);
        $this->currentChunk = [];
    }
}
