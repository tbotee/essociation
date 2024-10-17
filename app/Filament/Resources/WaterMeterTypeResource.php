<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaterMeterTypeResource\Pages;
use App\Filament\Resources\WaterMeterTypeResource\RelationManagers;
use App\Models\WaterMeterType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaterMeterTypeResource extends Resource
{
    protected static ?string $model = WaterMeterType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->formatStateUsing(function ($state) {
                        return __($state);
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => !$record->read_only),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => !$record->read_only),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageWaterMeterTypes::route('/'),
        ];
    }
}
