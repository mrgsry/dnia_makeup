@extends('admin.layouts.app')

@section('title', 'Syarat & Ketentuan')
@section('page_title', 'Syarat & Ketentuan')

@section('content')
<div class="card card-gold card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-list-alt mr-1"></i> Data Syarat & Ketentuan</h3>
        <div class="card-tools">
            <a href="{{ route('admin.terms.create') }}" class="btn btn-gold btn-sm">
                <i class="fa fa-plus mr-1"></i> Tambah
            </a>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th style="width: 70px;">Icon</th>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th style="width: 90px;">Urutan</th>
                    <th style="width: 90px;">Aktif</th>
                    <th style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($terms as $index => $term)
                    <tr>
                        <td>{{ $terms->firstItem() + $index }}</td>
                        <td><i class="{{ $term->icon }} text-gold fa-lg"></i></td>
                        <td><strong>{{ $term->title }}</strong></td>
                        <td>{{ Str::limit(strip_tags($term->content), 80) }}</td>
                        <td>{{ $term->sort_order }}</td>
                        <td>
                            @if($term->is_active)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.terms.edit', $term) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.terms.destroy', $term) }}" method="POST" class="d-inline" data-confirm="Hapus syarat/ketentuan ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data syarat & ketentuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        {{ $terms->links() }}
    </div>
</div>
@endsection
