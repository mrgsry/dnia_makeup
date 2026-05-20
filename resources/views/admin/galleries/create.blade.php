@extends('admin.layouts.app')

@section('title', 'Tambah Galeri')

@section('page_title', 'Tambah Galeri')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-gold card-outline">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Galeri</h3>
            </div>
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" data-confirm="Apakah Anda yakin ingin menambah galeri ini?">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Judul galeri" value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi singkat tentang galeri ini...">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Galeri</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image" required>
                            <label class="custom-file-label" for="image">Pilih gambar...</label>
                        </div>
                        <small class="form-text text-muted">Format: jpg, jpeg, png, webp. Maksimal 2MB.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-gold">
                        <i class="fa fa-save"></i> Simpan Galeri
                    </button>
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
