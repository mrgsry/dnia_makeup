@extends('admin.layouts.app')

@section('title', 'Tambah Paket')

@section('page_title', 'Tambah Paket')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-gold card-outline">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Paket</h3>
            </div>
            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" data-confirm="Apakah Anda yakin ingin menambah paket ini?">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug">Slug (ID Unik)</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="contoh: mini, silver, vip" value="{{ old('slug') }}" required>
                                <small class="form-text text-muted">Gunakan huruf kecil, tanpa spasi (contoh: mini, silver, vip).</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Paket</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="contoh: Paket Dnia Wedding Mini" value="{{ old('name') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi Singkat</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi singkat tentang paket ini...">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Paket</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="image">Pilih gambar...</label>
                        </div>
                        <small class="form-text text-muted">Format: jpg, jpeg, png, webp. Maksimal 2MB.</small>
                    </div>

                    <div class="form-group">
                        <label for="facilities">Fasilitas & Isi Paket</label>
                        <p class="text-muted">Masukkan satu fasilitas per baris.</p>
                        <textarea class="form-control" id="facilities" name="facilities[]" rows="8" placeholder="Contoh:
- Konsultasi dan perencanaan konsep acara
- Koordinasi rundown acara
- Tim wedding organizer pada hari-H
- Pendampingan teknis untuk keluarga dan calon pengantin"
                        >{{ old('facilities.0', '') }}</textarea>
                        <small class="form-text text-muted">Setiap baris akan menjadi satu item fasilitas.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-gold">
                        <i class="fa fa-save"></i> Simpan Paket
                    </button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
