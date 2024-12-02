<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Filament\Resources\ScanResource;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Components\Section;
use Filament\Actions;

class ViewScan extends ViewRecord
{
    protected static string $resource = ScanResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        $sections = [
            Section::make()
                ->schema([
                    Infolists\Components\TextEntry::make('pentesting.title'),
                    Infolists\Components\TextEntry::make('name_nmap_timing')
                        ->label('Nmap timing'),
                    Infolists\Components\TextEntry::make('progress'),
                ])->columns(3)
        ];

        $results = $this->record->getResults();

        foreach ($results as $result) {
            $type = $result->type;
            unset($result->_id, $result->scan_id, $result->type);

            $sections[] = Section::make($type)
                ->schema([
                    Infolists\Components\TextEntry::make('details')
                        ->getStateUsing($result->toJson(JSON_PRETTY_PRINT))
                        ->columnSpan(2),
                    Infolists\Components\TextEntry::make('recommendations')
                        ->getStateUsing($result->recommendations)
                ])
                ->columns(3)
                ->collapsible()
                ->collapsed();
        }

        return $infolist
            ->schema($sections);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Refresh')
                ->icon('heroicon-o-arrow-path'),
        ];
    }
}
