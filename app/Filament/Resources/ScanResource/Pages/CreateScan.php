<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Filament\Resources\ScanResource;
use App\Jobs\RunScan;
use Filament\Resources\Pages\CreateRecord;

class CreateScan extends CreateRecord
{
    protected static string $resource = ScanResource::class;

    protected function afterCreate(): void
    {
        $this->record->update([
            'steps' => count(config('scan.endpoints'))
        ]);

        RunScan::dispatch($this->record);
    }
}
