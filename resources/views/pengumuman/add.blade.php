@extends('layouts.main')

@section('content')
    <title>Data Pengumuman</title>

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
            <i class="fas fa-plus mr-2"></i>Tambah Data Pengumuman
        </div>
        <form class="form-horizontal" method="post" action="{{ route('pengumuman.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="tgl_publikasi" class="col-sm-3 col-form-label required">Tanggal Publikasi</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="tgl_publikasi" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="judul" class="col-sm-3 col-form-label required">Judul Pengumuman</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="judul" required maxlength="40">
                        <small class="form-text text-muted">Maksimum 40 karakter</small>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="fileInput" name="gambar"
                            accept="image/jpeg, image/png, image/jpg, image/svg">
                        <small class="form-text text-muted">Gambar harus bertipe: jpeg, png, jpg, atau svg</small>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="deskripsi" class="col-sm-3 col-form-label required">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="deskripsi" required></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/pengumuman'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
