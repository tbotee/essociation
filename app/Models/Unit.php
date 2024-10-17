<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

    public function residences(): HasMany
    {
        return $this->hasMany(Residence::class);
    }

    public function waterMeter(): MorphOne
    {
        return $this->morphOne(WaterMeter::class, 'water_meter');
    }
}
