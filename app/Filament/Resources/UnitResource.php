<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitResource\Pages;
use App\Models\WaterMeterType;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('association_id')
                    ->relationship('association', 'name')
                    ->required(),
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
                Forms\Components\Fieldset::make('Water Meter')
                    ->relationship('waterMeter')
                    ->schema([
                        Forms\Components\TextInput::make('code'),
                        Forms\Components\Select::make('water_meter_type_id')
                            ->options(
                                WaterMeterType::where(
                                    'slug', config('constants.readOnlyEaterMeterTypes.associationMeter')
                                )
                                    ->select('id', 'name')
                                    ->get()
                                    ->pluck('name', 'id')
                                    ->mapWithKeys(function ($item, $key) {
                                        return [$key => __($item)];
                                    })
                            ),
                        Forms\Components\Placeholder::make('delete_button')
                            ->label('')
                            ->content(function () {
                                return view('filament.components.delete-button');
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('association.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('association.name'),
                Tables\Columns\TextColumn::make('association.city.name'),
                Tables\Columns\TextColumn::make('association.region.name'),
                Tables\Columns\TextColumn::make('street')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('block')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stairwell')
                    ->searchable(),
                Tables\Columns\TextColumn::make('waterMeter.waterMeterType.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnits::route('/'),
            'create' => Pages\CreateUnit::route('/create'),
            'edit' => Pages\EditUnit::route('/{record}/edit'),
            'residences' => Pages\ManageResidences::route('/{record}/residences'),
            'costs' => Pages\ManageCosts::route('/{record}/costs'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditUnit::class,
            Pages\ManageResidences::class,
            Pages\ManageCosts::class
        ]);
    }
}
