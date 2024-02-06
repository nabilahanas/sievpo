@extends('layouts.main')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">

            <h5 class="card-title fw-bolder mb-3">Tambah Lokasi</h5>

            <form method="post" action="{{ route('lokasi.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nama_lokasi" class="form-label">Nama Lokasi</label>
                    <input type="text" class="form-control" name="nama_lokasi" required>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" name="latitude" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" name="longitude" required>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                    <a type="button" class="btn btn-danger" href="/lokasi">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection
