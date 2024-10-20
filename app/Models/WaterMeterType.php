<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaterMeterType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'order',
    ];

    protected $casts = [
        'read_only' => 'boolean',
        'order' => 'integer',
    ];


    public function delete(): bool
    {
        if (!$this->read_only) {
            return parent::delete();
        }
        return false;
    }

    public function save(array $options = [])
    {
        if ($this->read_only) {
            return false;
        }
        return parent::save($options);
    }

    public function update(array $attributes = [], array $options = [])
    {
        if ($this->read_only) {
            return false;
        }
        return parent::update($attributes, $options);
    }
}
