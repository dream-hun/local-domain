<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
    protected $fillable = [
        'name',
        'api_url',
        'api_key',
        'api_secret',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
