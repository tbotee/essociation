<?php

namespace App\Filament\Resources\AssociationResource\Pages;

use App\Filament\Resources\AssociationResource;
use App\Traits\PageFullWidth;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;
use Filament\Tables;

class AssociationUsers extends ManageRelatedRecords
{
    use PageFullWidth;

    protected static string $resource = AssociationResource::class;

    protected static string $relationship = 'associationUsers';

    protected static ?string $navigationIcon = 'heroicon-m-users';

    public function getBreadcrumb(): string
    {
        return 'Users';
    }

    public static function getNavigationLabel(): string
    {
        return 'Users';
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('user.email'),
                Tables\Columns\TextColumn::make('role_id')
                    ->formatStateUsing(function ($state) {
                        return $state == config('constants.roles.admin') ? 'Admin' : 'Chairman';
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
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
