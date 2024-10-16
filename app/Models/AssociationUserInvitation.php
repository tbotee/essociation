<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociationUserInvitation extends Model
{
    protected $fillable = [
        'email',
        'association_id',
        'role_id',
        'encrypted_data',
        'status',
    ];
}
