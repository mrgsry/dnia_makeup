@extends('admin.layouts.app')

@section('title', 'Pembayaran')
@section('page_title', 'Pembayaran')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
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
                            <td class="text-success font-weight-bold">Rp {{ number_format($booking->total_paid, 0, ',', '.') }}</td>
                            <td class="text-danger font-weight-bold">Rp {{ number_format($booking->remaining_bill, 0, ',', '.') }}</td>
                            <td>
                                @if($booking->payment_status === 'Lunas')
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($booking->payment_status === 'DP / Cicil')
                                    <span class="badge badge-warning">DP / Cicil</span>
                                @else
                                    <span class="badge badge-secondary">{{ $booking->payment_status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.payments.create', ['booking_id' => $booking->id]) }}" class="btn btn-primary btn-sm mb-1">
                                    <i class="fa fa-plus"></i> Bayar
                                </a>
                                @if($booking->payments->isNotEmpty())
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-1" data-toggle="modal" data-target="#paymentModal-{{ $booking->id }}">
                                        <i class="fa fa-eye"></i> Detail
                                    </button>
                                @endif
                                @php
                                    $phone = preg_replace('/[^0-9]/', '', $booking->phone);
                                    if (substr($phone, 0, 1) === '0') {
                                        $phone = '62' . substr($phone, 1);
                                    }
                                    $sisaTagihan = number_format($booking->remaining_bill, 0, ',', '.');
                                    $message = "Halo {$booking->bride_name} & {$booking->groom_name},\n\n";
                                    $message .= "Kami dari Dnia Organizer ingin mengingatkan mengenai pembayaran untuk paket *{$booking->package}*.\n\n";
                                    $message .= "📋 Detail Pembayaran:\n";
                                    $message .= "• Nilai Paket: Rp " . number_format($booking->package_value, 0, ',', '.') . "\n";
                                    $message .= "• Sudah Dibayar: Rp " . number_format($booking->total_paid, 0, ',', '.') . "\n";
                                    $message .= "• Sisa Tagihan: Rp {$sisaTagihan}\n\n";
                                    if ($booking->payment_status === 'Lunas') {
                                        $message .= "✅ Status: Lunas\n\n";
                                        $message .= "Terima kasih atas kepercayaan Anda! 🙏";
                                    } else {
                                        $message .= "⚠️ Status: Belum Lunas\n\n";
                                        $message .= "Mohon untuk segera melakukan pembayaran agar acara Anda dapat berjalan lancar.\n\n";
                                        $message .= "Silakan hubungi kami jika ada pertanyaan. Terima kasih! 🙏";
                                    }
                                    $waLink = 'https://wa.me/' . $phone . '?text=' . urlencode($message);
                                @endphp
                                <a href="{{ $waLink }}" target="_blank" class="btn btn-success btn-sm mb-1" title="Kirim Pesan WhatsApp">
                                    <i class="fa fa-whatsapp"></i> Pesan
                                </a>
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
        <div class="modal fade" id="paymentModal-{{ $booking->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary-modern text-white">
                        <h5 class="modal-title">
                            <i class="fa fa-credit-card mr-2"></i> Detail Pembayaran
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card bg-primary-modern text-white mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong><i class="fa fa-users mr-1"></i> {{ $booking->bride_name }} & {{ $booking->groom_name }}</strong><br>
                                        <i class="fa fa-phone mr-1"></i> {{ $booking->phone }}<br>
                                        <i class="fa fa-gift mr-1"></i> {{ $booking->package ?? '-' }}<br>
                                        <i class="fa fa-calendar mr-1"></i> {{ $booking->event_date?->format('d M Y') }}
                                    </div>
                                    <div class="col-md-6">
                                        <i class="fa fa-money mr-1"></i> Nilai Paket: <strong>Rp {{ number_format($booking->package_value, 0, ',', '.') }}</strong><br>
                                        <i class="fa fa-check-circle mr-1"></i> Terbayar: <strong class="text-white">Rp {{ number_format($booking->total_paid, 0, ',', '.') }}</strong><br>
                                        <i class="fa fa-exclamation-circle mr-1"></i> Sisa: <strong class="text-white">Rp {{ number_format($booking->remaining_bill, 0, ',', '.') }}</strong><br>
                                        Status:
                                        @if($booking->payment_status === 'Lunas')
                                            <span class="badge badge-success">Lunas</span>
                                        @elseif($booking->payment_status === 'DP / Cicil')
                                            <span class="badge badge-warning">DP / Cicil</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $booking->payment_status }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h6 class="mt-3"><i class="fa fa-list mr-2"></i>Riwayat Pembayaran</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Ke</th>
                                        <th>Label</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Metode</th>
                                        <th>Catatan</th>
                                        <th>Bukti</th>
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
                                                    <span class="badge badge-success">Pelunasan</span>
                                                @else
                                                    <span class="badge badge-warning">DP {{ $payment->payment_number }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $payment->payment_date?->format('d M Y') }}</td>
                                            <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                            <td>{{ $payment->payment_method ?? '-' }}</td>
                                            <td>{{ $payment->notes ?? '-' }}</td>
                                            <td>
                                                @if($payment->payment_proof)
                                                    <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-image"></i> Lihat
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

@endsection
