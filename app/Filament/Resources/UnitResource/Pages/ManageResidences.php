<?php

namespace App\Filament\Resources\UnitResource\Pages;

use App\Filament\Resources\UnitResource;
use App\Traits\PageFullWidth;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;

class ManageResidences extends ManageRelatedRecords
{
    use PageFullWidth;

    protected static string $resource = UnitResource::class;

    protected static string $relationship = 'residences';

    public function getBreadcrumb(): string
    {
        return 'Residences';
    }

    public static function getNavigationLabel(): string
    {
        return 'Residences';
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nr')
            ->columns([
                Tables\Columns\TextColumn::make('nr'),
                Tables\Columns\TextColumn::make('floor'),
                Tables\Columns\TextColumn::make('room_count'),
                Tables\Columns\TextColumn::make('base_area'),
                Tables\Columns\TextColumn::make('resident_count'),
                Tables\Columns\TextColumn::make('unit.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nr')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('floor')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Forms\Components\TextInput::make('room_count')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(1),
                Forms\Components\TextInput::make('base_area')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Forms\Components\TextInput::make('resident_count')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
            ]);
    }
}
