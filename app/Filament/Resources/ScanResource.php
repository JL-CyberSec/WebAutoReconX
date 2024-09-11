<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScanResource\Pages;
use App\Models\Scan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScanResource extends Resource
{
    protected static ?string $model = Scan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('nmap_timing')
                    ->required(),
                Forms\Components\Select::make('pentesting_id')
                    ->relationship('pentesting', 'title')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $hasPentesting = !empty(request()->route()->parameter('pentestingId'));

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_type')
                    ->label('Type'),
                Tables\Columns\TextColumn::make('name_nmap_timing')
                    ->label('Timing'),
                Tables\Columns\TextColumn::make('pentesting.title')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: $hasPentesting),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScans::route('/{pentestingId?}'),
            'create' => Pages\CreateScan::route('/create/{pentestingId?}'),
            'view' => Pages\ViewScan::route('/{record}/view'),
            'edit' => Pages\EditScan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])->when(!empty(request()->route()->parameter('pentestingId')), function ($query) {
                return $query->where('pentesting_id', request()->route()->parameter('pentestingId'));
            });
    }
}
