<?php

namespace App\Filament\Widgets;

use App\Models\Scan;
use Filament\Widgets\ChartWidget;

class ScansChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $maxHeight = '300px';

    protected int | string | array $columnSpan = 2;

    protected static ?string $heading = 'Scans Overview';

    protected function getData(): array
    {
        $labels = ['Completed', 'In Progress', 'Pending', 'Deleted'];

        $data = [
            Scan::whereRaw('status = steps')->count(),
            Scan::whereRaw('status BETWEEN 1 AND steps - 1')->count(),
            Scan::where('status', 0)->count(),
            Scan::onlyTrashed()->count(),
        ];

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Scans',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgb(152, 251, 152)',
                        'rgb(255, 205, 86)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                    ],
                ],
            ]
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
