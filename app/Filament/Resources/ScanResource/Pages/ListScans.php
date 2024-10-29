<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Filament\Resources\ScanResource;
use App\Models\Pentesting;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListScans extends ListRecords
{
    protected static string $resource = ScanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->url(fn() => route('filament.admin.resources.scans.create', [
                    'pentestingId' => request()->route()->parameter('pentestingId')
                ])),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        $pentestingId = request()->route()->parameter('pentestingId');
        $hasPentesting = !empty($pentestingId);

        if ($hasPentesting) {
            $pentesting = Pentesting::findOrFail($pentestingId);
            return "Scans of {$pentesting->title}";
        }

        return 'All Scans';
    }
}
