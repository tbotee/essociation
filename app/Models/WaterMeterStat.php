<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WaterMeterStat extends Model
{
    protected $fillable = [
        'meterable_id',
        'meterable_type',
        'date',
        'value'
    ];

    public function waterMeter(): BelongsTo
    {
        return $this->belongsTo(WaterMeter::class);
    }
}
