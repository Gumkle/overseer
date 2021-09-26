<?php

namespace App\Application\Power\Downloader;

use Closure;
use DateTimeImmutable;

interface PowerProductionDownloaderBuilder
{
    public function producer(string $producer): PowerProductionDownloaderBuilder;

    public function since(DateTimeImmutable $since): PowerProductionDownloaderBuilder;

    public function until(DateTimeImmutable $until): PowerProductionDownloaderBuilder;

    public function chunked(Closure $closure, int $chunkSize = 100): PowerProductionDownloaderBuilder;

    public function build(): PowerProductionDownloader;
}
