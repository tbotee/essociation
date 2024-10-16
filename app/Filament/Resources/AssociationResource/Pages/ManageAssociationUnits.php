<?php

namespace App\Filament\Resources\AssociationResource\Pages;

use App\Filament\Resources\AssociationResource;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class ManageAssociationUnits extends ManageRelatedRecords
{
    protected static string $resource = AssociationResource::class;

    protected static string $relationship = 'units';
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public function getBreadcrumb(): string
    {
        return 'Units';
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Units';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('street')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('block')
                    ->maxLength(255),
                Forms\Components\TextInput::make('stairwell')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('street'),
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\TextColumn::make('block'),
                Tables\Columns\TextColumn::make('stairwell'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
