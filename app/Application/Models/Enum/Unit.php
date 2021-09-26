<?php

namespace App\Application\Models\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static Unit KWH()
 * @method static Unit WH()
 * @method static Unit MWH()
 */
class Unit extends Enum
{
    private const KWH = 'kWh';
    private const WH = 'Wh';
    private const MWH = 'MWh';
}
