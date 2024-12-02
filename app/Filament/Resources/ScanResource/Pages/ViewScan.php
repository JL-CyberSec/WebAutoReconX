<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Filament\Resources\ScanResource;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Components\Section;
use Filament\Actions;
use App\View\Components\TextEntryJson;

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
            $recommendations = $result->recommendations;
            unset($result->_id, $result->scan_id, $result->type, $result->recommendations);

            $sections[] = Section::make($type)
                ->schema([
                    TextEntryJson::make('details')
                        ->getStateUsing($result->toJson(JSON_PRETTY_PRINT))
                        ->columnSpan(3),
                    Infolists\Components\TextEntry::make('recommendations')
                        ->getStateUsing($recommendations)
                        ->columnSpan(2),
                ])
                ->columns(5)
                ->collapsible()
                ->collapsed();
        }

        return $infolist
            ->schema($sections);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
            Actions\Action::make('Refresh')
                ->icon('heroicon-o-arrow-path'),
        ];
    }
}
