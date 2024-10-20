<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Association extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'city_id',
        'region_id',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    public function associationUsers(): HasMany
    {
        return $this->hasMany(AssociationUser::class);
    }

    public function userInvitation(): HasMany
    {
        return $this->hasMany(AssociationUserInvitation::class);
    }

    public function costs(): HasMany
    {
        return $this->hasMany(AssociationCost::class);
    }

    public function waterMeter(): MorphOne
    {
        return $this->morphOne(WaterMeter::class, 'water_meter');
    }
}
