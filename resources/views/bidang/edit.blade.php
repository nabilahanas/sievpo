@extends('layouts.page')

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

            <h5 class="card-title fw-bolder mb-3">Ubah Data Bidang</h5>

            <form method="post" action="{{ route('bidang.update', $bidang->id_bidang) }}">
                @csrf
                <div class="mb-3">
                    <label for="nama_bidang" class="form-label">Nama Bidang</label>
                    <input type="text" class="form-control" id="nama_bidang" name="nama_bidang"
                        value="{{ $bidang->nama_bidang }}" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                        value="{{ $bidang->deskripsi }}" required>
            </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Ubah" />
                    <a type="button" class="btn btn-danger" href="/bidang">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection
