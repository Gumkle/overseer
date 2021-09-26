<?php

namespace App\Interfaces\Console\Commands;

use App\Application\Services\UpdatePowerProductionReads;
use Illuminate\Console\Command;

class DownloadEntrypoint extends Command
{
    protected $signature = 'app:download';
    protected $description = 'Downloads power production for all plants';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(UpdatePowerProductionReads $service)
    {
        $service->handle();
    }
}
