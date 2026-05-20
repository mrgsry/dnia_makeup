@extends('admin.layouts.app')

@section('title', 'Edit Galeri')

@section('page_title', 'Edit Galeri')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-gold card-outline">
            <div class="card-header">
                <h3 class="card-title">Form Edit Galeri</h3>
            </div>
            <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" data-confirm="Apakah Anda yakin ingin mengupdate galeri ini?">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Judul galeri" value="{{ old('title', $gallery->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi singkat tentang galeri ini...">{{ old('description', $gallery->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Galeri</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="image">Pilih gambar...</label>
                        </div>
                        <small class="form-text text-muted">Format: jpg, jpeg, png, webp. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                        @if($gallery->image)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="Preview" style="max-width:220px;border-radius:10px;">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-gold">
                        <i class="fa fa-save"></i> Update Galeri
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
