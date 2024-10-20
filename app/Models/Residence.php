<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Residence extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nr',
        'floor',
        'room_count',
        'base_area',
        'resident_count',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function waterMeters(): MorphMany
    {
        return $this->morphMany(WaterMeter::class, 'water_meter');
    }

    public function owners(): HasMany
    {
        return $this->hasMany(Owner::class);
    }

    public function residenceUsers(): HasMany
    {
        return $this->hasMany(ResidenceUser::class);
    }
}
