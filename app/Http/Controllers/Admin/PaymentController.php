<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('payments')
            ->orderBy('event_date', 'desc')
            ->get();

        return view('admin.payments.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        $bookings = Booking::orderBy('event_date', 'desc')->get();
        $selectedBooking = null;
        $nextPaymentNumber = 1;

        if ($request->booking_id) {
            $selectedBooking = Booking::with('payments')->find($request->booking_id);
            if ($selectedBooking) {
                $nextPaymentNumber = $selectedBooking->payments()->count() + 1;
            }
        }

        return view('admin.payments.create', compact('bookings', 'selectedBooking', 'nextPaymentNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_number' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $booking = Booking::with('payments')->findOrFail($validated['booking_id']);
        $remaining = $booking->remaining_bill;

        if ($booking->package_value <= 0) {
            return back()->withInput()->withErrors([
                'amount' => 'Nilai paket pada booking ini belum diisi, jadi pembayaran belum bisa dicatat.',
            ]);
        }

        if ((float) $validated['amount'] > (float) $remaining) {
            return back()->withInput()->withErrors([
                'amount' => 'Jumlah pembayaran melebihi sisa tagihan (Rp ' . number_format($remaining, 0, ',', '.') . ').',
            ]);
        }

        Payment::create($validated);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show(Payment $payment)
    {
        return redirect()->route('admin.payments.edit', $payment);
    }

    public function edit(Payment $payment)
    {
        $payment->load('booking.payments');
        $bookings = Booking::orderBy('event_date', 'desc')->get();

        return view('admin.payments.edit', compact('payment', 'bookings'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_number' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $booking = Booking::with('payments')->findOrFail($validated['booking_id']);

        if ($booking->package_value <= 0) {
            return back()->withInput()->withErrors([
                'amount' => 'Nilai paket pada booking ini belum diisi, jadi pembayaran belum bisa dicatat.',
            ]);
        }

        $totalPaidWithoutCurrent = (float) $booking->payments()
            ->where('id', '!=', $payment->id)
            ->sum('amount');
        $remaining = max(0, (float) $booking->package_value - $totalPaidWithoutCurrent);

        if ((float) $validated['amount'] > $remaining) {
            return back()->withInput()->withErrors([
                'amount' => 'Jumlah pembayaran melebihi sisa tagihan (Rp ' . number_format($remaining, 0, ',', '.') . ').',
            ]);
        }

        $payment->update($validated);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
