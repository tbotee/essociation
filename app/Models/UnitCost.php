<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitCost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'unit_id',
        'name',
        'amount',
        'is_monthly',
        'date',
        'type'
    ];

    protected $casts = [
        'is_monthly' => 'boolean',
        'date' => 'date'
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
