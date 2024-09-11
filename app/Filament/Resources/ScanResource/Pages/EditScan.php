<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Enums\NmapTiming;
use App\Enums\ScanType;
use App\Filament\Resources\ScanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;
use Filament\Forms\Form;

class EditScan extends EditRecord
{
    protected static string $resource = ScanResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
