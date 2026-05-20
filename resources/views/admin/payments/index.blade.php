@extends('admin.layouts.app')

@section('title', 'Pembayaran')
@section('page_title', 'Pembayaran')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0"><i class="fa fa-credit-card mr-2"></i> Rekap Pembayaran Booking</h3>
        <a href="{{ route('admin.payments.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i> Tambah Pembayaran</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Booking</th>
                        <th>Paket</th>
                        <th>Tanggal Acara</th>
                        <th>Nilai Paket</th>
                        <th>Terbayar</th>
                        <th>Sisa</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>
                                <strong>{{ $booking->bride_name }} & {{ $booking->groom_name }}</strong><br>
                                <small class="text-muted">{{ $booking->phone }}</small>
                            </td>
                            <td>{{ $booking->package ?? '-' }}</td>
                            <td>{{ $booking->event_date?->format('d M Y') }}</td>
                            <td>Rp {{ number_format($booking->package_value, 0, ',', '.') }}</td>
                            <td class="text-success fw-bold">Rp {{ number_format($booking->total_paid, 0, ',', '.') }}</td>
                            <td class="text-danger fw-bold">Rp {{ number_format($booking->remaining_bill, 0, ',', '.') }}</td>
                            <td>
                                @if($booking->payment_status === 'Lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @elseif($booking->payment_status === 'DP / Cicil')
                                    <span class="badge bg-warning text-dark">DP / Cicil</span>
                                @else
                                    <span class="badge bg-secondary">{{ $booking->payment_status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.payments.create', ['booking_id' => $booking->id]) }}" class="btn btn-primary btn-sm mb-1">
                                    <i class="fa fa-plus"></i> Bayar
                                </a>
                                @if($booking->payments->isNotEmpty())
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#paymentModal-{{ $booking->id }}">
                                        <i class="fa fa-eye"></i> Detail
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($bookings as $booking)
    @if($booking->payments->isNotEmpty())
        <div class="modal fade" id="paymentModal-{{ $booking->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-credit-card mr-2"></i> Detail Pembayaran
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <strong>{{ $booking->bride_name }} & {{ $booking->groom_name }}</strong><br>
                            Paket: {{ $booking->package ?? '-' }}<br>
                            Tanggal Acara: {{ $booking->event_date?->format('d M Y') }}<br>
                            Nilai Paket: Rp {{ number_format($booking->package_value, 0, ',', '.') }}<br>
                            Sudah Dibayar: Rp {{ number_format($booking->total_paid, 0, ',', '.') }}<br>
                            Sisa Tagihan: <strong>Rp {{ number_format($booking->remaining_bill, 0, ',', '.') }}</strong>
                        </div>

                        <h6 class="mt-3"><i class="fa fa-list mr-2"></i>Riwayat Pembayaran</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ke</th>
                                        <th>Label</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Metode</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($booking->payments as $payment)
                                        <tr>
                                            <td>{{ $payment->payment_number }}</td>
                                            <td>
                                                @php
                                                    $isPelunasan = ($booking->package_value > 0) && ($booking->payments->where('payment_number', '<=', $payment->payment_number)->sum('amount') >= $booking->package_value);
                                                @endphp
                                                @if($isPelunasan)
                                                    <span class="badge bg-success">Pelunasan</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">DP {{ $payment->payment_number }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $payment->payment_date?->format('d M Y') }}</td>
                                            <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                            <td>{{ $payment->payment_method ?? '-' }}</td>
                                            <td>{{ $payment->notes ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pembayaran ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

@endsection
