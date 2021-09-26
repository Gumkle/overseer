<?php

namespace App\Infrastructure\Browser\Interfaces;


use App\Application\Models\PowerPlant;

interface Browser
{
    public function openHuaweiPage(PowerPlant $plant): HuaweiPage;
}
