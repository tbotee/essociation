<?php

namespace App\Filament\Resources\CityResource\Pages;

use App\Filament\Resources\CityResource;
use App\Traits\PageFullWidth;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCities extends ManageRecords
{
    use PageFullWidth;

    protected static string $resource = CityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
