@extends('admin.layouts.app')

@section('title', 'Tambah Pembayaran')
@section('page_title', 'Tambah Pembayaran')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0"><i class="fa fa-plus mr-2"></i> Input Pembayaran</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.payments.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Pilih Booking</label>
                        <select name="booking_id" class="form-control @error('booking_id') is-invalid @enderror" required onchange="window.location='{{ route('admin.payments.create') }}?booking_id=' + this.value">
                            <option value="">-- Pilih Booking --</option>
                            @foreach($bookings as $booking)
                                <option value="{{ $booking->id }}" {{ old('booking_id', $selectedBooking?->id) == $booking->id ? 'selected' : '' }}>
                                    {{ $booking->bride_name }} & {{ $booking->groom_name }} - {{ $booking->event_date?->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('booking_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    @if($selectedBooking)
                        <div class="alert alert-info">
                            <strong>Info Booking:</strong><br>
                            Paket: {{ $selectedBooking->package ?? '-' }}<br>
                            Tanggal Acara: {{ $selectedBooking->event_date?->format('d M Y') }}<br>
                            Nilai Paket: Rp {{ number_format($selectedBooking->package_value, 0, ',', '.') }}<br>
                            Sudah Dibayar: Rp {{ number_format($selectedBooking->total_paid, 0, ',', '.') }}<br>
                            Sisa Tagihan: <strong>Rp {{ number_format($selectedBooking->remaining_bill, 0, ',', '.') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Pembayaran Ke</label>
                        <input type="number" name="payment_number" class="form-control @error('payment_number') is-invalid @enderror" value="{{ old('payment_number', $nextPaymentNumber) }}" min="1" required>
                        @error('payment_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Pembayaran</label>
                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" min="0" step="1000" placeholder="Contoh: 1000000" required>
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Pembayaran</label>
                        <input type="date" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', date('Y-m-d')) }}" required>
                        @error('payment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <input type="text" name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" value="{{ old('payment_method') }}" placeholder="Transfer / Cash / QRIS">
                        @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3" placeholder="Catatan tambahan...">{{ old('notes') }}</textarea>
                        @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> Simpan Pembayaran</button>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
