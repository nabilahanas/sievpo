@extends('layouts.main')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
    <div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Tambah Pengumuman</h5>

        <form method="post" action="{{ route('pengumuman.store') }}">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Pengumuman</label>
                <input type="text" class="form-control" name="judul" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="text" class="form-control" name="gambar">
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" name="deskripsi" required>
            </div>
            <div class="mb-3">
                <label for="tgl_publikasi" class="form-label">Tanggal Publikasi</label>
                <input type="text" class="form-control" name="tgl_publikasi" required>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>

@endsection