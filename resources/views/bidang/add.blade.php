@extends('layouts.main')

@section('content')
    <title>Tambah Bidang</title>

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
            <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Data Bidang</h3>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('bidang.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_bidang" class="col-sm-2 col-form-label">Nama Bidang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_bidang" placeholder="Masukkan Nama Bidang">
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Bidang"
                            required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" value="Tambah"><i class="fas fa-save"></i>
                        Simpan</button>
                    <a type="button" class="btn btn-danger" href="/bidang"><i class="fas fa-reply"></i> Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection
