@extends('admin.layouts.app')

@section('title', 'Testimoni')
@section('page_title', 'Manajemen Testimoni')

@section('content')
<div class="card card-gold card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-quote-right mr-1"></i> Data Testimoni</h3>
        <div class="card-tools">
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-gold btn-sm">
                <i class="fa fa-plus mr-1"></i> Tambah Testimoni
            </a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Pasangan</th>
                    <th>Tanggal Event</th>
                    <th>Isi Testimoni</th>
                    <th style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $index => $testimonial)
                    <tr>
                        <td>{{ $testimonials->firstItem() + $index }}</td>
                        <td><strong>{{ $testimonial->client_names }}</strong></td>
                        <td>{{ $testimonial->event_date }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($testimonial->content, 90) }}</td>
                        <td>
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" data-confirm="Hapus testimoni ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data testimoni.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $testimonials->links() }}
    </div>
</div>
@endsection

