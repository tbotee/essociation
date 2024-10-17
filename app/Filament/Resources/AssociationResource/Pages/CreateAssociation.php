<?php

namespace App\Filament\Resources\AssociationResource\Pages;

use App\Filament\Resources\AssociationResource;
use App\Traits\PageFullWidth;
use Filament\Resources\Pages\CreateRecord;

class CreateAssociation extends CreateRecord
{
    use PageFullWidth;

    protected static string $resource = AssociationResource::class;
}
