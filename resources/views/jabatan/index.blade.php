@extends('layouts.page')

@section('content')

<h4 class="mt-5">Data Jabatan</h4>

<a href="{{ route('jabatan.add') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Jabatan</th>
        <th>Wilayah</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($jabatan as $jabatan)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $jabatan->nama_jabatan }}</td>
                <td>
                        @if($jabatan->wilayah == 0) Wilayah Timur
                        @elseif($jabatan->wilayah == 1) Wilayah Barat
                        @endif
                </td>
                <td>
                    <a href="{{ route('jabatan.edit', $jabatan->id_jabatan) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <form action="{{route('jabatan.delete', $jabatan->id_jabatan)}}" method="post" class="d-inline">
                        @csrf
                        @method('POST')
                        <button class="btn btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection