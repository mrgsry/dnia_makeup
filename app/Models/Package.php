<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'description',
        'facilities',
        'image',
    ];

    protected $casts = [
        'facilities' => 'array',
    ];
}
