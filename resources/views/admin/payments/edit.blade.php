@extends('admin.layouts.app')

@section('title', 'Edit Pembayaran')
@section('page_title', 'Edit Pembayaran')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0"><i class="fa fa-edit mr-2"></i> Edit Pembayaran</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.payments.update', $payment) }}" method="POST" enctype="multipart/form-data">
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
                        <input type="text" name="amount" id="amount" class="form-control money-input @error('amount') is-invalid @enderror" value="{{ old('amount', number_format($payment->amount, 0, ',', '.')) }}" placeholder="Contoh: 1.000.000" required>
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Format otomatis dengan pemisah ribuan.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Pembayaran</label>
                        <input type="date" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', $payment->payment_date?->format('Y-m-d')) }}" required>
                        @error('payment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="payment_method" class="form-control @error('payment_method') is-invalid @enderror">
                            <option value="">-- Pilih Metode --</option>
                            <option value="QRIS" {{ old('payment_method', $payment->payment_method) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                            <option value="Transfer" {{ old('payment_method', $payment->payment_method) == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                            <option value="CASH" {{ old('payment_method', $payment->payment_method) == 'CASH' ? 'selected' : '' }}>CASH</option>
                        </select>
                        @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bukti Pembayaran (Opsional)</label>
                        @if($payment->payment_proof)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-image mr-1"></i> Lihat Bukti Saat Ini
                                </a>
                            </div>
                        @endif
                        <input type="file" name="payment_proof" class="form-control @error('payment_proof') is-invalid @enderror" accept="image/*" capture="environment">
                        @error('payment_proof')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Bisa ambil foto langsung atau pilih dari galeri. Kosongkan jika tidak ingin mengganti bukti.</small>
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

@push('scripts')
<script>
    document.querySelectorAll('.money-input').forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            e.target.value = value ? parseInt(value, 10).toLocaleString('id-ID') : '';
        });
    });
</script>
@endpush
