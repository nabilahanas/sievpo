@extends('layouts.main')

@section('content')
    <title>Data Shift</title>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card card-successv2">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Data Shift</h3>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('shift.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_shift" class="col-sm-2 col-form-label">Nama Shift</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_shift" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="jam_mulai" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="jam_akhir" class="col-sm-2 col-form-label">Jam Akhir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="jam_akhir" required>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                    <a type="button" class="btn btn-danger" href="/shift"><i class="fas fa-reply"></i> Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection
