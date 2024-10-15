<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    protected $fillable = [
        'association_id',
        'name',
        'street',
        'number',
        'block',
        'stairwell',
    ];

    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }
}
