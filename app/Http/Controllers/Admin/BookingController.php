<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $booking = new Booking();
        return view('admin.bookings.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'event_date' => 'required|date',
            'event_type' => 'required|string|max:255',
            'package' => 'nullable|string|in:mini,silver,vip,diamond,aula,glamour',
            'location' => 'required|string|max:255',
            'budget' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        Booking::create($validated);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil ditambahkan.');
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'event_date' => 'required|date',
            'event_type' => 'required|string|max:255',
            'package' => 'nullable|string|in:mini,silver,vip,diamond,aula,glamour',
            'location' => 'required|string|max:255',
            'budget' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
