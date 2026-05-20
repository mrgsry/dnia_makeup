@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')

@section('page_title', 'Manajemen Galeri')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-gold card-outline">
            <div class="card-header">
                <h3 class="card-title">Daftar Galeri</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.galleries.create') }}" class="btn btn-gold">
                        <i class="fa fa-plus"></i> Tambah Galeri
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($galleries as $gallery)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($gallery->image)
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" style="width:90px;height:60px;object-fit:cover;border-radius:8px;">
                                    @else
                                        <span class="badge badge-secondary">No Image</span>
                                    @endif
                                </td>
                                <td><strong>{{ $gallery->title }}</strong></td>
                                <td>{{ Str::limit($gallery->description, 50) }}</td>
                                <td>
                                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline" data-confirm="Apakah Anda yakin ingin menghapus galeri {{ $gallery->title }}?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada galeri tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
