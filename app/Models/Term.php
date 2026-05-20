<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'content',
        'sort_order',
        'is_active',
    ];
}
