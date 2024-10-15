<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function associations(): HasMany
    {
        return $this->hasMany(Association::class);
    }
}
