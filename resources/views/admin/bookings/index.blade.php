@extends('admin.layouts.app')

@section('title', 'Booking Acara')
@section('page_title', 'Manajemen Booking Acara')

@section('content')
<div class="card card-gold card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-calendar-check-o mr-1"></i> Data Booking</h3>
        <div class="card-tools">
            <a href="{{ route('admin.bookings.create') }}" class="btn btn-gold btn-sm">
                <i class="fa fa-plus mr-1"></i> Tambah Booking
            </a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Calon Pengantin</th>
                    <th>Kontak</th>
                    <th>Tanggal Acara</th>
                    <th>Jenis Acara</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $index => $booking)
                    <tr>
                        <td>{{ $bookings->firstItem() + $index }}</td>
                        <td><strong>{{ $booking->bride_name }}</strong> & <strong>{{ $booking->groom_name }}</strong></td>
                        <td>
                            <div><i class="fa fa-envelope mr-1"></i> {{ $booking->email }}</div>
                            <div><i class="fa fa-phone mr-1"></i> {{ $booking->phone }}</div>
                        </td>
                        <td>{{ $booking->event_date->format('d M Y') }}</td>
                        <td>{{ $booking->event_type }}</td>
                        <td>{{ $booking->location }}</td>
                        <td>
                            @if($booking->status === 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($booking->status === 'confirmed')
                                <span class="badge badge-success">Confirmed</span>
                            @else
                                <span class="badge badge-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline" data-confirm="Hapus booking ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada data booking acara.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
