<?php

namespace App\Filament\Widgets;

use App\Models\Pentesting;
use App\Models\Project;
use App\Models\Scan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Projects', Project::count()),
            Stat::make('Pentestings', Pentesting::count()),
            Stat::make('Scans', Scan::count()),
        ];
    }
}
