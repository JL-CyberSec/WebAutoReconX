<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Infolists\Components\Section;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Section::make()->schema([
                Infolists\Components\TextEntry::make('title'),
                Infolists\Components\TextEntry::make('description'),
            ])->columns(2)
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
