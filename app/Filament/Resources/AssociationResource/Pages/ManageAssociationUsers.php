<?php

namespace App\Filament\Resources\AssociationResource\Pages;

use App\Filament\Resources\AssociationResource;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;

class ManageAssociationUsers extends ManageRelatedRecords
{
    protected static string $resource = AssociationResource::class;

    protected static string $relationship = 'users';

    public function getBreadcrumb(): string
    {
        return 'Users';
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Users';
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('pivot.role_id')
                    ->formatStateUsing(function ($state) {
                        return $state == config('constants.ROLE_ADMIN') ? 'Admin' : 'Chairman';
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
