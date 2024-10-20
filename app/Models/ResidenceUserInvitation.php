<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResidenceUserInvitation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'email',
        'residence_id',
        'unit_id',
        'encrypted_data',
        'status',
    ];

    public function residence(): BelongsTo
    {
        return $this->belongsTo(Residence::class);
    }
}
