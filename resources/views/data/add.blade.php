@extends('layouts.main')

@section('content')
    <title>Data Eviden</title>

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
            <i class="fas fa-plus mr-2"></i>Tambah Data Eviden
        </div>
        <form class="form-horizontal" method="post" action="">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="" class="col-sm-2 col-form-label required">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_user" value="{{ auth()->user()->nama_user }}" required disabled>

                        {{-- untuk menyimpan nilai yang akan dikirim ke database --}}
                        <input type="hidden" name="nama_hidden" value="{{ auth()->user()->nama_user }}">
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="" class="col-sm-2 col-form-label required">Bidang</label>
                    <div class="col-sm-10">
                        <select name="id_bidang" id="" class="form-control">
                            <option value="" disabled selected>Pilih Bidang</option>
                            @foreach ($bidang as $bidang)
                            <option value="{{ $bidang->id_bidang }}">{{ $bidang->nama_bidang}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="tgl_waktu" class="col-sm-2 col-form-label required">Tanggal Waktu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tgl_waktu" id="tgl_waktu" value="{{ old('tgl_waktu', $formattedDateTime)}}" disabled>
                        <span id="detik"></span>
                    </div>
                </div>
                <div class="text-center">
                    <button type="sumbit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/data'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>

@endsection
