<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua booking untuk kalender dengan info lengkap
        $bookings = Booking::select('id', 'event_date', 'bride_name', 'groom_name', 'status', 'package', 'location', 'phone')
            ->orderBy('event_date', 'asc')
            ->get();

        // Format untuk kalender: grouping by date
        $calendarEvents = $bookings->map(function($booking) {
            return [
                'id' => $booking->id,
                'date' => $booking->event_date->format('Y-m-d'),
                'title' => $booking->bride_name . ' & ' . $booking->groom_name,
                'status' => $booking->status,
                'package' => $booking->package ?? 'Belum dipilih',
                'location' => $booking->location ?? '-',
                'phone' => $booking->phone ?? '-',
                'eventDate' => $booking->event_date->format('d M Y'),
            ];
        });

        return view('admin.dashboard', [
            'serviceCount' => Service::count(),
            'testimonialCount' => Testimonial::count(),
            'bookingCount' => Booking::count(),
            'calendarEvents' => $calendarEvents,
        ]);
    }
}
