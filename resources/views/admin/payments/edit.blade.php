@extends('admin.layouts.app')

@section('title', 'Edit Pembayaran')
@section('page_title', 'Edit Pembayaran')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0"><i class="fa fa-edit mr-2"></i> Edit Pembayaran</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.payments.update', $payment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Pilih Booking</label>
                        <select name="booking_id" class="form-control @error('booking_id') is-invalid @enderror" required>
                            @foreach($bookings as $booking)
                                <option value="{{ $booking->id }}" {{ old('booking_id', $payment->booking_id) == $booking->id ? 'selected' : '' }}>
                                    {{ $booking->bride_name }} & {{ $booking->groom_name }} - {{ $booking->event_date?->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('booking_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="alert alert-info">
                        <strong>Info Booking:</strong><br>
                        Paket: {{ $payment->booking->package ?? '-' }}<br>
                        Tanggal Acara: {{ $payment->booking->event_date?->format('d M Y') }}<br>
                        Nilai Paket: Rp {{ number_format($payment->booking->package_value, 0, ',', '.') }}<br>
                        Sudah Dibayar: Rp {{ number_format($payment->booking->total_paid, 0, ',', '.') }}<br>
                        Sisa Tagihan: <strong>Rp {{ number_format($payment->booking->remaining_bill, 0, ',', '.') }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Pembayaran Ke</label>
                        <input type="number" name="payment_number" class="form-control @error('payment_number') is-invalid @enderror" value="{{ old('payment_number', $payment->payment_number) }}" min="1" required>
                        @error('payment_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Pembayaran</label>
                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $payment->amount) }}" min="0" step="1000" required>
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Pembayaran</label>
                        <input type="date" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', $payment->payment_date?->format('Y-m-d')) }}" required>
                        @error('payment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <input type="text" name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" value="{{ old('payment_method', $payment->payment_method) }}" placeholder="Transfer / Cash / QRIS">
                        @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $payment->notes) }}</textarea>
                        @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> Update Pembayaran</button>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
