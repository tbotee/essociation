<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }
}
