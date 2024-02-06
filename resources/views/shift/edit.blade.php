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

            <h5 class="card-title fw-bolder mb-3">Ubah Data Shift</h5>

            <form method="post" action="{{ route('shift.update', $shift->id_shift) }}">
                @csrf
                <div class="mb-3">
                    <label for="nama_shift" class="form-label">Nama Shift</label>
                    <input type="text" class="form-control" id="nama_shift" name="nama_shift"
                        value="{{ $shift->nama_shift }}" required>
                </div>
                <div class="mb-3">
                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="text" class="form-control" id="jam_mulai" name="jam_mulai"
                        value="{{ $shift->jam_mulai }}" required>
                </div>
                <div class="mb-3">
                    <label for="jam_akhir" class="form-label">Jam Akhir</label>
                    <input type="text" class="form-control" id="jam_akhir" name="jam_akhir"
                        value="{{ $shift->jam_akhir }}" required>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Ubah" />
                    <a type="button" class="btn btn-danger" href="/shift">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection
