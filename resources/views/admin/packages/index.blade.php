@extends('admin.layouts.app')

@section('title', 'Manajemen Paket')

@section('page_title', 'Manajemen Paket')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-gold card-outline">
            <div class="card-header">
                <h3 class="card-title">Daftar Paket Dnia Wedding Organizer</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.packages.create') }}" class="btn btn-gold">
                        <i class="fa fa-plus"></i> Tambah Paket
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
                                <th>Nama Paket</th>
                                <th>Slug</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($packages as $package)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($package->image)
                                        <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" style="width:90px;height:60px;object-fit:cover;border-radius:8px;">
                                    @else
                                        <span class="badge badge-secondary">No Image</span>
                                    @endif
                                </td>
                                <td><strong>{{ $package->name }}</strong></td>
                                <td><code>{{ $package->slug }}</code></td>
                                <td>
                                    <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="d-inline" data-confirm="Apakah Anda yakin ingin menghapus paket {{ $package->name }}?">
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
                                <td colspan="5" class="text-center">Belum ada paket tersedia.</td>
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


