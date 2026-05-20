<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Booking;
use Carbon\Carbon;

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

        // Total booking belum lunas
        $unpaidBookings = Booking::whereHas('payments', function($query) {
            // Booking yang punya pembayaran tapi belum lunas
        })->orWhereDoesntHave('payments')->count();

        // Lebih akurat: hitung dari payment_status
        $unpaidBookings = Booking::get()->filter(function($booking) {
            return $booking->payment_status !== 'Lunas';
        })->count();

        // Total acara minggu ini (event_date dalam 7 hari ke depan dari hari ini)
        $startOfWeek = Carbon::now()->startOfDay();
        $endOfWeek = Carbon::now()->addDays(7)->endOfDay();
        $eventsThisWeek = Booking::whereBetween('event_date', [$startOfWeek, $endOfWeek])->count();

        return view('admin.dashboard', [
            'serviceCount' => Service::count(),
            'testimonialCount' => Testimonial::count(),
            'bookingCount' => Booking::count(),
            'unpaidBookings' => $unpaidBookings,
            'eventsThisWeek' => $eventsThisWeek,
            'calendarEvents' => $calendarEvents,
        ]);
    }
}
