<?php

namespace App\Traits;

use Filament\Support\Enums\MaxWidth;

trait PageFullWidth
{
    public function getMaxContentWidth(): ?string
    {
        return MaxWidth::Full->value;
    }
}
