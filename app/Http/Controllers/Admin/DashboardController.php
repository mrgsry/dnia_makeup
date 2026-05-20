<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua booking untuk kalender
        $bookings = Booking::select('event_date', 'bride_name', 'groom_name', 'status')
            ->orderBy('event_date', 'asc')
            ->get();

        // Format untuk kalender: grouping by date
        $calendarEvents = $bookings->map(function($booking) {
            return [
                'date' => $booking->event_date->format('Y-m-d'),
                'title' => $booking->bride_name . ' & ' . $booking->groom_name,
                'status' => $booking->status,
            ];
        });

        return view('admin.dashboard', [
            'serviceCount' => Service::count(),
            'portfolioCount' => Portfolio::count(),
            'testimonialCount' => Testimonial::count(),
            'bookingCount' => Booking::count(),
            'calendarEvents' => $calendarEvents,
        ]);
    }
}
