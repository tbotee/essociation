<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssociationUserInvitation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'email',
        'association_id',
        'role_id',
        'encrypted_data',
        'status',
    ];
}
