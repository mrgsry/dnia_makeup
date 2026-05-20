<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'payment_number',
        'amount',
        'payment_date',
        'payment_method',
        'notes',
        'payment_proof',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function getPaymentLabelAttribute()
    {
        $booking = $this->relationLoaded('booking') ? $this->booking : $this->booking()->with('payments')->first();

        if (!$booking) {
            return 'DP ' . $this->payment_number;
        }

        $totalPaidUntilThis = $booking->payments
            ->where('payment_number', '<=', $this->payment_number)
            ->sum('amount');

        if ($booking->package_value > 0 && $totalPaidUntilThis >= $booking->package_value) {
            return 'Pelunasan';
        }

        return 'DP ' . $this->payment_number;
    }
}
