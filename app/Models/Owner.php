<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Owner extends Model
{
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
