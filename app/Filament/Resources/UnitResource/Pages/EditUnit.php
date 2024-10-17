<?php

namespace App\Filament\Resources\UnitResource\Pages;

use App\Filament\Resources\UnitResource;
use App\Traits\PageFullWidth;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUnit extends EditRecord
{
    use PageFullWidth;

    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function deleteWaterMeter(): void
    {
        $association = $this->getRecord();
        if ($association->waterMeter) {
            $association->waterMeter->delete();
            Notification::make()
                ->success()
                ->title(__('removed_water_meter'))
                ->send();
            $this->fillForm();
        }
    }
}
