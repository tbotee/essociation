<?php

namespace App\Filament\Resources\UnitResource\Pages;

use App\Filament\Resources\UnitResource;
use App\Models\WaterMeterType;
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
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
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
                                    ->default(0)
                            ]),
                        Forms\Components\Tabs\Tab::make('Water Meters')
                            ->schema([
                                Forms\Components\Repeater::make(__('waterMeters'))
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\TextInput::make('code')
                                            ->required(),
                                        Forms\Components\Select::make('water_meter_type_id')
                                            ->options(WaterMeterType::whereNull('slug')
                                                ->select('id', 'name')
                                                ->get()
                                                ->pluck('name', 'id')
                                                ->mapWithKeys(function ($item, $key) {
                                                    return [$key => __($item)];
                                                })
                                            )
                                            ->required()
                                    ])
                            ]),
                        Forms\Components\Tabs\Tab::make('Owners')
                            ->schema([
                                Forms\Components\Repeater::make(__('owners'))
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\Fieldset::make('Label')
                                            ->schema([
                                                Forms\Components\Radio::make('type')
                                                    ->options([
                                                        (string) config('constants.ownerType.person') => __('person'),
                                                        (string) config('constants.ownerType.company') => __('company'),
                                                    ])
                                                    ->inline(true)
                                                    ->required()
                                                    ->default(config('constants.ownerType.person'))
                                                    ->reactive(),
                                            ]),
                                        Forms\Components\Fieldset::make('Person')
                                            ->schema([
                                                Forms\Components\TextInput::make('first_name')
                                                    ->required(fn (Get $get): bool => $get('type') == config('constants.ownerType.person'))
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('last_name')
                                                    ->required(fn (Get $get): bool => $get('type') == config('constants.ownerType.person'))
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('cnp')
                                                    ->required(fn (Get $get): bool => $get('type') == config('constants.ownerType.person'))
                                                    ->maxLength(255),
                                            ])
                                            ->visible(
                                                fn (Get $get): bool => $get('type') == config('constants.ownerType.person')
                                            ),
                                        Forms\Components\Fieldset::make('Company')
                                            ->schema([
                                                Forms\Components\TextInput::make('company_name')
                                                    ->required(fn (Get $get): bool => $get('type') == config('constants.ownerType.company'))
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('cui')
                                                    ->required(fn (Get $get): bool => $get('type') == config('constants.ownerType.company'))
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('registry_number')
                                                    ->required(fn (Get $get): bool => $get('type') == config('constants.ownerType.company'))
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('email')
                                                    ->maxLength(255),
                                            ])
                                            ->visible(
                                                fn (Get $get): bool => $get('type') == config('constants.ownerType.company')
                                            ),
                                        Forms\Components\TextInput::make('ownership_percentage')
                                            ->required(),
                                        Forms\Components\TextInput::make('address')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                            ])
                    ])
            ]);
    }
}
