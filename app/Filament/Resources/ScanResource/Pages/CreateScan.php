<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Enums\NmapTiming;
use App\Enums\ScanType;
use App\Filament\Resources\ScanResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;

class CreateScan extends CreateRecord
{
    protected static string $resource = ScanResource::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')
                ->options(ScanType::toArray())
                ->required(),
            Forms\Components\Select::make('nmap_timing')
                ->options(NmapTiming::toArray())
                ->required(),
            Forms\Components\Hidden::make('pentesting_id')
                ->default(request()->route()->parameter('pentestingId')),
        ]);
    }

    protected function getRedirectUrl(): string
    {
        // Check if 'pentestingId' exists in the query and add it to the redirect URL
        if ($this->record->pentesting_id) {
            return route('filament.admin.resources.scans.index', [
                'pentestingId' => $this->record->pentesting_id,
            ]);
        }

        // Default redirection to the resource index page
        return parent::getRedirectUrl();
    }
}
