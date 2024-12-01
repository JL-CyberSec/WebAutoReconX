<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Filament\Resources\ScanResource;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Components\Section;

class ViewScan extends ViewRecord
{
    protected static string $resource = ScanResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()->schema([
                    Infolists\Components\TextEntry::make('pentesting.title'),
                    Infolists\Components\TextEntry::make('name_nmap_timing')
                        ->label('Nmap timing'),
                    Infolists\Components\TextEntry::make('progress'),
                ])->columns(3)
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
