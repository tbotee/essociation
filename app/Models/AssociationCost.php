<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssociationCost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'association_id',
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

    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }
}
