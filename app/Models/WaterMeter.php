<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaterMeter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'water_meter_type',
        'water_meter_id',
        'code',
        'water_meter_type_id',
    ];

    public function waterMeter(): MorphTo
    {
        return $this->morphTo();
    }

    public function waterMeterType(): BelongsTo
    {
        return $this->belongsTo(WaterMeterType::class, 'water_meter_type_id');
    }
}
