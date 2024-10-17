<?php

namespace App\Filament\Resources\AssociationResource\Pages;

use App\Filament\Resources\AssociationResource;
use App\Traits\PageFullWidth;
use Filament\Resources\Pages\EditRecord;

class EditAssociation extends EditRecord
{
    use PageFullWidth;

    protected static string $resource = AssociationResource::class;
}
