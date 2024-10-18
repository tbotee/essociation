<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssociationResource\Pages;
use App\Models\Association;
use App\Models\City;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Filament\Pages\SubNavigationPosition;

class AssociationResource extends Resource
{
    protected static ?string $model = Association::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('region_id')
                    ->relationship('region', 'name')
                    ->required()
                    ->reactive(),
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->required()
                    ->options(function (Get $get) {
                        if ($get('region_id') !== null) {
                            return City::where('region_id', $get('region_id'))->pluck('name', 'id');
                        }
                        return [];
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region.name')
                    ->numeric()
                    ->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAssociations::route('/'),
            'create' => Pages\CreateAssociation::route('/create'),
            'edit' => Pages\EditAssociation::route('/{record}/edit'),
            'units' => Pages\ManageAssociationUnits::route('/{record}/units'),
            'users' => Pages\AssociationUsers::route('/{record}/users'),
            'invite_users' => Pages\InviteAssociationUsers::route('/{record}/invite-users'),
            'costs' => Pages\ManageAssociationCosts::route('/{record}/costs'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditAssociation::class,
            Pages\ManageAssociationUnits::class,
            Pages\ManageAssociationCosts::class,
            Pages\AssociationUsers::class,
            Pages\InviteAssociationUsers::class,
        ]);
    }
}
