<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

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

    public function costs(): HasMany
    {
        return $this->hasMany(UnitCost::class);
    }

    public function residenceUsers(): HasMany
    {
        return $this->hasMany(ResidenceUser::class);
    }

    public function userInvitations(): HasMany
    {
        return $this->hasMany(ResidenceUserInvitation::class);
    }

}
