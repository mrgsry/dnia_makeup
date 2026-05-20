@extends('admin.layouts.app')

@section('title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan')
@section('page_title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
<div class="card card-gold card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-edit mr-1"></i> Form Layanan</h3>
    </div>
    <form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}">
        @csrf
        @if($service->exists)
            @method('PUT')
        @endif
        <div class="card-body">
            <div class="form-group">
                <label>Icon</label>
                @php
                    $iconOptions = [
                        'fa fa-heart' => 'Heart (Wedding)',
                        'fa fa-diamond' => 'Diamond (Premium)',
                        'fa fa-camera' => 'Camera (Photo)',
                        'fa fa-video-camera' => 'Video',
                        'fa fa-music' => 'Music',
                        'fa fa-cutlery' => 'Catering',
                        'fa fa-gift' => 'Gift',
                        'fa fa-map-marker' => 'Location',
                        'fa fa-building' => 'Venue',
                        'fa fa-users' => 'Team',
                        'fa fa-leaf' => 'Decoration',
                        'fa fa-star' => 'Star',
                    ];
                    $selectedIcon = old('icon', $service->icon ?? 'fa fa-heart');
                @endphp

                <div class="d-flex align-items-center" style="gap:12px;">
                    <div style="width:44px;height:44px;border-radius:10px;background:#fff;display:flex;align-items:center;justify-content:center;border:1px solid #e5e5e5;">
                        <i id="iconPreview" class="{{ $selectedIcon }} text-gold fa-2x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <select class="form-control @error('icon') is-invalid @enderror" name="icon" id="iconSelect">
                            @foreach($iconOptions as $value => $label)
                                <option value="{{ $value }}" {{ $selectedIcon === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih icon yang tersedia (Font Awesome 4).</small>
                        @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Judul Layanan</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $service->title ?? '') }}" placeholder="Contoh: Wedding Planning">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Deskripsi layanan...">{{ old('description', $service->description ?? '') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-gold"><i class="fa fa-save mr-1"></i> Simpan</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var select = document.getElementById('iconSelect');
        var preview = document.getElementById('iconPreview');
        if (!select || !preview) return;

        var sync = function() {
            preview.className = select.value + ' text-gold fa-2x';
        };

        select.addEventListener('change', sync);
        sync();
    });
</script>
@endpush
