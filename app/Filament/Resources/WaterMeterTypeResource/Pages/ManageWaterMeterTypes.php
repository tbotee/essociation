<?php

namespace App\Filament\Resources\WaterMeterTypeResource\Pages;

use App\Filament\Resources\WaterMeterTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWaterMeterTypes extends ManageRecords
{
    protected static string $resource = WaterMeterTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
