<?php

namespace App\Enums;

use App\Traits\Enum;

enum NmapTiming: string
{
    use Enum;

    case Paranoid = '0';
    case Sneaky = '1';
    case Polite = '2';
    case Normal = '3';
    case Aggressive = '4';
    case Insane = '5';
}
