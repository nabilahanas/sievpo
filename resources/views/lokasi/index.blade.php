@extends('layouts.main')

@section('content')

<h4 class="mt-5">Data Lokasi</h4>

<a href="{{ route('lokasi.add') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Lokasi</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($lokasi as $lokasi)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $lokasi->nama_lokasi }}</td>
                <td>{{ $lokasi->latitude }}</td>
                <td>{{ $lokasi->longitude }}</td>
                <td>
                    <a href="{{ route('lokasi.edit', $lokasi->id_lokasi) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <form action="{{route('lokasi.delete', $lokasi->id_lokasi)}}" method="post" class="d-inline">
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