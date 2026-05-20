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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getPackageValueAttribute()
    {
        if (!$this->budget) {
            return 0;
        }

        return (float) preg_replace('/[^0-9]/', '', $this->budget);
    }

    public function getTotalPaidAttribute()
    {
        return (float) $this->payments()->sum('amount');
    }

    public function getRemainingBillAttribute()
    {
        return max(0, $this->package_value - $this->total_paid);
    }

    public function getPaymentStatusAttribute()
    {
        if ($this->package_value <= 0) {
            return 'Nilai Paket Belum Diisi';
        }

        if ($this->total_paid >= $this->package_value) {
            return 'Lunas';
        }

        if ($this->total_paid > 0) {
            return 'DP / Cicil';
        }

        return 'Belum Bayar';
    }
}
