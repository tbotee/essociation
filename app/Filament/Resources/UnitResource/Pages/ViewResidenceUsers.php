<?php

namespace App\Filament\Resources\UnitResource\Pages;

use App\Filament\Resources\UnitResource;
use App\Traits\PageFullWidth;
use Carbon\Carbon;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;
use Filament\Tables;

class ViewResidenceUsers extends ManageRelatedRecords
{
    use PageFullWidth;

    protected static string $resource = UnitResource::class;

    protected static string $relationship = 'residenceUsers';

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
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
