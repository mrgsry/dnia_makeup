@extends('admin.layouts.app')

@section('title', 'Tambah Syarat & Ketentuan')
@section('page_title', 'Tambah Syarat & Ketentuan')

@section('content')
<div class="card card-gold card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-plus mr-1"></i> Form Tambah</h3>
    </div>
    <form method="POST" action="{{ route('admin.terms.store') }}">
        @csrf
        @include('admin.terms._form', ['term' => $term])
        <div class="card-footer">
            <button type="submit" class="btn btn-gold"><i class="fa fa-save mr-1"></i> Simpan</button>
            <a href="{{ route('admin.terms.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
