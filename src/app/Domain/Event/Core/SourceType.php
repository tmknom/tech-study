<?php

namespace App\Domain\Event\Core;

use App\Library\Fundamental\Enum;

class SourceType
{

    use Enum;

    const ATND = 'atnd';
    const CONNPASS = 'connpass';
    const DOORKEEPER = 'doorkeeper';
    const ZUSAAR = 'zusaar';
    const PARTAKE = 'partake';
    const KOKUCHEESE = 'kokucheese';

}
