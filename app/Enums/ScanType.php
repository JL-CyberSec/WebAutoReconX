<?php

namespace App\Enums;

use App\Traits\Enum;

enum ScanType: string
{
    use Enum;

    case BlackBox = 'blackbox';
    case WhiteBox = 'whitebox';
}
