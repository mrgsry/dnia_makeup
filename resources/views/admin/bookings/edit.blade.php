@extends('admin.layouts.app')

@section('title', $booking->exists ? 'Edit Booking' : 'Tambah Booking')
@section('page_title', $booking->exists ? 'Edit Booking' : 'Tambah Booking')

@section('content')
<div class="card card-gold card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-edit mr-1"></i> Form Booking Acara</h3>
    </div>
    <form method="POST" action="{{ $booking->exists ? route('admin.bookings.update', $booking) : route('admin.bookings.store') }}">
        @csrf
        @if($booking->exists)
            @method('PUT')
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Calon Pengantin Wanita</label>
                        <input type="text" class="form-control @error('bride_name') is-invalid @enderror" name="bride_name" value="{{ old('bride_name', $booking->bride_name ?? '') }}">
                        @error('bride_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Calon Pengantin Pria</label>
                        <input type="text" class="form-control @error('groom_name') is-invalid @enderror" name="groom_name" value="{{ old('groom_name', $booking->groom_name ?? '') }}">
                        @error('groom_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $booking->email ?? '') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $booking->phone ?? '') }}">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Acara</label>
                        <input type="date" class="form-control @error('event_date') is-invalid @enderror" name="event_date" value="{{ old('event_date', $booking->event_date ? $booking->event_date->format('Y-m-d') : '') }}">
                        @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Acara</label>
                        <select class="form-control @error('event_type') is-invalid @enderror" name="event_type">
                            <option value="">Pilih Jenis Acara</option>
                            <option value="Pernikahan" {{ old('event_type', $booking->event_type ?? '') == 'Pernikahan' ? 'selected' : '' }}>Pernikahan</option>
                            <option value="Engagement" {{ old('event_type', $booking->event_type ?? '') == 'Engagement' ? 'selected' : '' }}>Engagement</option>
                            <option value="Bridal Shower" {{ old('event_type', $booking->event_type ?? '') == 'Bridal Shower' ? 'selected' : '' }}>Bridal Shower</option>
                            <option value="Akad Nikah" {{ old('event_type', $booking->event_type ?? '') == 'Akad Nikah' ? 'selected' : '' }}>Akad Nikah</option>
                            <option value="Resepsi" {{ old('event_type', $booking->event_type ?? '') == 'Resepsi' ? 'selected' : '' }}>Resepsi</option>
                        </select>
                        @error('event_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location', $booking->location ?? '') }}">
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Paket</label>
                        <select class="form-control @error('package') is-invalid @enderror" name="package" id="package">
                            <option value="">Pilih Paket</option>
                            <option value="mini" data-price="15000000" {{ old('package', $booking->package ?? '')=='mini' ? 'selected' : '' }}>Paket Dnia Wedding Mini: Rp. 15,000,000</option>
                            <option value="silver" data-price="20000000" {{ old('package', $booking->package ?? '')=='silver' ? 'selected' : '' }}>Paket Dnia Wedding Silver: Rp. 20,000,000</option>
                            <option value="vip" data-price="23500000" {{ old('package', $booking->package ?? '')=='vip' ? 'selected' : '' }}>Paket Dnia Wedding VIP: Rp. 23,500,000</option>
                            <option value="diamond" data-price="26500000" {{ old('package', $booking->package ?? '')=='diamond' ? 'selected' : '' }}>Paket Dnia Wedding Diamond: Rp. 26,500,000</option>
                            <option value="aula" data-price="29800000" {{ old('package', $booking->package ?? '')=='aula' ? 'selected' : '' }}>Paket Dnia Wedding Aula: Rp. 29,800,000</option>
                            <option value="glamour" data-price="33500000" {{ old('package', $booking->package ?? '')=='glamour' ? 'selected' : '' }}>Paket Dnia Wedding Glamour: Rp. 33,500,000</option>
                        </select>
                        @error('package') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="form-text text-muted">Budget akan otomatis terisi mengikuti paket yang dipilih.</small>
                    </div>

                    <div class="form-group">
                        <label>Budget</label>
                        <input type="text" class="form-control @error('budget') is-invalid @enderror" name="budget" id="budget" value="{{ old('budget', $booking->budget ?? '') }}" placeholder="Otomatis terisi dari paket">
                        @error('budget') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control @error('status') is-invalid @enderror" name="status">
                    <option value="pending" {{ old('status', $booking->status ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status', $booking->status ?? '') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ old('status', $booking->status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Catatan Tambahan</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" rows="4">{{ old('notes', $booking->notes ?? '') }}</textarea>
                @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-gold"><i class="fa fa-save mr-1"></i> Simpan</button>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function formatRupiah(number) {
        try {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
        } catch (e) {
            return 'Rp. ' + String(number).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    }

    function syncBudgetFromPackage() {
        var packageSelect = document.getElementById('package');
        var budgetInput = document.getElementById('budget');
        if (!packageSelect || !budgetInput) return;

        var opt = packageSelect.options[packageSelect.selectedIndex];
        var price = opt ? opt.getAttribute('data-price') : null;
        if (!price) return;

        budgetInput.value = formatRupiah(parseInt(price, 10));
    }

    document.addEventListener('DOMContentLoaded', function () {
        var packageSelect = document.getElementById('package');
        if (packageSelect) {
            packageSelect.addEventListener('change', syncBudgetFromPackage);
            syncBudgetFromPackage();
        }
    });
</script>
@endpush
