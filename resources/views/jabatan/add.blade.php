@extends('layouts.main')

@section('content')
    <title>Data Jabatan</title>

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
            <i class="fas fa-plus mr-2"></i>Tambah Data Jabatan
        </div>
        <form class="form-horizontal" method="post" action="{{ route('jabatan.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_jabatan" class="col-sm-2 col-form-label required">Nama Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_jabatan" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="wilayah" class="col-sm-2 col-form-label required">Wilayah</label>
                    <div class="col-sm-10">
                        <select name="wilayah" id="wilayah" class="custom-select" required>
                            <option value="" disabled selected>Pilih Wilayah</option>
                            <option value="1">Wilayah Barat</option>
                            <option value="0">Wilayah Timur</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="bagian" class="col-sm-2 col-form-label required">Bagian</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="bagian" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="klasifikasi" class="col-sm-2 col-form-label required">Klasifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="klasifikasi" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/jabatan'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
