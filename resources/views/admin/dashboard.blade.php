@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gold-custom">
            <div class="inner">
                <h3>{{ $bookingCount }}</h3>
                <p>Booking Acara</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar-check-o"></i>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">Kelola <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $serviceCount }}</h3>
                <p>Layanan</p>
            </div>
            <div class="icon">
                <i class="fa fa-heart"></i>
            </div>
            <a href="{{ route('admin.services.index') }}" class="small-box-footer">Kelola <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $portfolioCount }}</h3>
                <p>Portfolio</p>
            </div>
            <div class="icon">
                <i class="fa fa-picture-o"></i>
            </div>
            <a href="{{ route('admin.portfolios.index') }}" class="small-box-footer">Kelola <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $testimonialCount }}</h3>
                <p>Testimoni</p>
            </div>
            <div class="icon">
                <i class="fa fa-quote-right"></i>
            </div>
            <a href="{{ route('admin.testimonials.index') }}" class="small-box-footer">Kelola <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-gold card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar mr-1"></i> Kalender Booking Acara</h3>
            </div>
            <div class="card-body p-2">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-gold card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-line-chart mr-1"></i> Ringkasan Website</h3>
            </div>
            <div class="card-body">
                <p class="mb-2">Admin panel ini dipakai untuk mengelola konten website public Dnia Organizer.</p>
                <ul class="mb-0">
                    <li>Input booking calon pengantin.</li>
                    <li>Kelola layanan wedding organizer.</li>
                    <li>Upload portfolio acara.</li>
                    <li>Kelola testimoni klien.</li>
                </ul>
            </div>
        </div>

        <div class="card card-gold card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-link mr-1"></i> Quick Action</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.bookings.create') }}" class="btn btn-gold btn-block mb-2"><i class="fa fa-plus mr-1"></i> Tambah Booking</a>
                <a href="{{ route('admin.services.create') }}" class="btn btn-outline-secondary btn-block mb-2"><i class="fa fa-plus mr-1"></i> Tambah Layanan</a>
                <a href="{{ route('admin.portfolios.create') }}" class="btn btn-outline-secondary btn-block"><i class="fa fa-plus mr-1"></i> Tambah Portfolio</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css">
<style>
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        font-size: 0.85em; /* perkecil ukuran teks */
    }
    .fc .fc-toolbar {
        font-size: 0.9em;
    }
    .fc .fc-button {
        padding: 0.25rem 0.5rem;
        font-size: 0.85em;
    }
    .fc .fc-dom-1 {
        font-size: 1.1em;
    }
    .fc-event {
        cursor: pointer;
        padding: 1px 4px;
        font-size: 0.85em;
    }
    .fc-event.status-pending {
        background-color: #ffc107 !important;
        border-color: #ffc107 !important;
    }
    .fc-event.status-confirmed {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }
    .fc-event.status-cancelled {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var events = @json($calendarEvents);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 450, // set maximum height agar tidak terlalu besar
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek'
            },
            events: events.map(function(event) {
                return {
                    title: event.title,
                    start: event.date,
                    className: 'status-' + event.status,
                    extendedProps: {
                        status: event.status
                    }
                };
            }),
            eventClick: function(info) {
                showInfoModal(
                    'Booking: ' + info.event.title + '\nStatus: ' + info.event.extendedProps.status,
                    'Detail Booking'
                );
            },
            locale: 'id',
            buttonText: {
                today: 'Hari Ini',
                month: 'Bulan',
                week: 'Minggu'
            }
        });

        calendar.render();
    });
</script>
@endpush
