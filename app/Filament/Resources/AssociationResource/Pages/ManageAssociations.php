<?php

namespace App\Filament\Resources\AssociationResource\Pages;

use App\Filament\Resources\AssociationResource;
use App\Traits\PageFullWidth;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAssociations extends ManageRecords
{
    use PageFullWidth;

    protected static string $resource = AssociationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
