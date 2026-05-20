@extends('admin.layouts.app')

@section('title', 'Edit Syarat & Ketentuan')
@section('page_title', 'Edit Syarat & Ketentuan')

@section('content')
<div class="card card-gold card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-edit mr-1"></i> Form Edit</h3>
    </div>
    <form method="POST" action="{{ route('admin.terms.update', $term) }}">
        @csrf
        @method('PUT')
        @include('admin.terms._form', ['term' => $term])
        <div class="card-footer">
            <button type="submit" class="btn btn-gold"><i class="fa fa-save mr-1"></i> Update</button>
            <a href="{{ route('admin.terms.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
