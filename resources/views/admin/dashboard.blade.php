@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-primary-modern">
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
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning-modern">
            <div class="inner">
                <h3>{{ $unpaidBookings }}</h3>
                <p>Booking Belum Lunas</p>
            </div>
            <div class="icon">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <a href="{{ route('admin.payments.index') }}" class="small-box-footer">Kelola <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info-modern">
            <div class="inner">
                <h3>{{ $eventsThisWeek }}</h3>
                <p>Acara Minggu Ini</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar"></i>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar mr-2"></i> Kalender Booking Acara</h3>
            </div>
            <div class="card-body p-2">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-line-chart mr-2"></i> Ringkasan Website</h3>
            </div>
            <div class="card-body">
                <p class="mb-2">Admin panel ini dipakai untuk mengelola konten website public Dnia Organizer.</p>
                <ul class="mb-0">
                    <li>Input booking calon pengantin.</li>
                    <li>Kelola layanan wedding organizer.</li>
                    <li>Kelola testimoni klien.</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-link mr-2"></i> Quick Action</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary btn-block mb-2"><i class="fa fa-plus mr-2"></i> Tambah Booking</a>
                <a href="{{ route('admin.services.create') }}" class="btn btn-outline-primary btn-block mb-2"><i class="fa fa-plus mr-2"></i> Tambah Layanan</a>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-outline-primary btn-block"><i class="fa fa-plus mr-2"></i> Tambah Testimoni</a>
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
                        id: event.id,
                        status: event.status,
                        package: event.package,
                        location: event.location,
                        phone: event.phone,
                        eventDate: event.eventDate
                    }
                };
            }),
            eventClick: function(info) {
                var props = info.event.extendedProps;
                var statusBadge = '';
                if (props.status === 'confirmed') {
                    statusBadge = '<span class="badge bg-success">Confirmed</span>';
                } else if (props.status === 'pending') {
                    statusBadge = '<span class="badge bg-warning">Pending</span>';
                } else if (props.status === 'cancelled') {
                    statusBadge = '<span class="badge bg-danger">Cancelled</span>';
                }

                var modalContent = `
                    <div class="booking-detail-modal">
                        <h5 class="mb-3">${info.event.title}</h5>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Status</strong></td>
                                <td>${statusBadge}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Acara</strong></td>
                                <td>${props.eventDate}</td>
                            </tr>
                            <tr>
                                <td><strong>Paket</strong></td>
                                <td>${props.package}</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi</strong></td>
                                <td>${props.location}</td>
                            </tr>
                            <tr>
                                <td><strong>Telepon</strong></td>
                                <td>${props.phone}</td>
                            </tr>
                        </table>
                        <div class="mt-3">
                            <a href="/admin/bookings/${props.id}/edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Booking</a>
                        </div>
                    </div>
                `;

                // Gunakan Bootstrap 5 Modal
                var modalHtml = `
                    <div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Booking</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ${modalContent}
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Hapus modal lama jika ada
                var oldModal = document.getElementById('bookingModal');
                if (oldModal) {
                    oldModal.remove();
                }

                // Tambahkan modal baru
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                var modal = new bootstrap.Modal(document.getElementById('bookingModal'));
                modal.show();
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
