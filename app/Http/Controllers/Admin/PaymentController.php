<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->merge([
            'amount' => preg_replace('/[^0-9]/', '', (string) $request->amount),
        ]);

        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_number' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'nullable|in:QRIS,Transfer,CASH',
            'payment_proof' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
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

        if ($request->hasFile('payment_proof')) {
            $validated['payment_proof'] = $request->file('payment_proof')->store('payment-proofs', 'public');
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
        $request->merge([
            'amount' => preg_replace('/[^0-9]/', '', (string) $request->amount),
        ]);

        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_number' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'nullable|in:QRIS,Transfer,CASH',
            'payment_proof' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
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

        if ($request->hasFile('payment_proof')) {
            if ($payment->payment_proof) {
                Storage::disk('public')->delete($payment->payment_proof);
            }

            $validated['payment_proof'] = $request->file('payment_proof')->store('payment-proofs', 'public');
        }

        $payment->update($validated);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->payment_proof) {
            Storage::disk('public')->delete($payment->payment_proof);
        }

        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
