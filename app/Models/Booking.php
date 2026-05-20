<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'bride_name',
        'groom_name',
        'email',
        'phone',
        'event_date',
        'event_type',
        'package',
        'location',
        'budget',
        'notes',
        'status'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
}
