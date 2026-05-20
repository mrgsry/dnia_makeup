@extends('admin.layouts.app')

@section('title', $testimonial->exists ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('page_title', $testimonial->exists ? 'Edit Testimoni' : 'Tambah Testimoni')

@section('content')
<div class="card card-gold card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-edit mr-1"></i> Form Testimoni</h3>
    </div>
    <form method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
        @csrf
        @if($testimonial->exists)
            @method('PUT')
        @endif
        <div class="card-body">
            <div class="form-group">
                <label>Nama Pasangan</label>
                <input type="text" class="form-control @error('client_names') is-invalid @enderror" name="client_names" value="{{ old('client_names', $testimonial->client_names ?? '') }}" placeholder="Contoh: Rina & Andi">
                @error('client_names') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Tanggal Event</label>
                <input type="text" class="form-control @error('event_date') is-invalid @enderror" name="event_date" value="{{ old('event_date', $testimonial->event_date ?? '') }}" placeholder="Contoh: Pernikahan Maret 2026">
                @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Isi Testimoni</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5" placeholder="Tulis testimoni dari klien...">{{ old('content', $testimonial->content ?? '') }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-gold"><i class="fa fa-save mr-1"></i> Simpan</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
