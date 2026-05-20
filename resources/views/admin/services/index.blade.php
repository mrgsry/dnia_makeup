@extends('admin.layouts.app')

@section('title', 'Layanan')
@section('page_title', 'Manajemen Layanan')

@section('content')
<div class="card card-gold card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-heart mr-1"></i> Data Layanan</h3>
        <div class="card-tools">
            <a href="{{ route('admin.services.create') }}" class="btn btn-gold btn-sm">
                <i class="fa fa-plus mr-1"></i> Tambah Layanan
            </a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Icon</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $index => $service)
                    <tr>
                        <td>{{ $services->firstItem() + $index }}</td>
                        <td><i class="{{ $service->icon }} text-gold fa-lg"></i></td>
                        <td><strong>{{ $service->title }}</strong></td>
                        <td>{{ Str::limit($service->description, 80) }}</td>
                        <td>
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" data-confirm="Hapus layanan ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data layanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $services->links() }}
    </div>
</div>
@endsection

