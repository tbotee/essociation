<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'first_name',
        'last_name',
        'cnp',
        'address',
        'phone',
        'cui',
        'company_name',
        'registry_number',
        'email',
    ];
}
