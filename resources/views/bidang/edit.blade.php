@extends('layouts.main')

@section('content')
    <title>Data Bidang</title>

    @if ($errors->any())
        <div class="alert alert-danger fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-warning" aria-hidden="true"></i></strong>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-successv2">
        <div class="card-header">
            <i class="fas fa-pen mr-2"></i>Ubah Data Bidang
        </div>
        <form method="post" action="{{ route('bidang.update', $bidang->id_bidang) }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_bidang" class="col-sm-2 col-form-label required">Nama Bidang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_bidang" name="nama_bidang"
                            value="{{ $bidang->nama_bidang }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="deskripsi" class="col-sm-2 col-form-label required">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                            value="{{ $bidang->deskripsi }}" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/bidang'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
