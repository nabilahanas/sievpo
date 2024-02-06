@extends('layouts.main')

@section('content')

<h4 class="mt-5">Data Wilayah</h4>

<a href="{{ route('wilayah.add') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Nama Wilayah</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Deskripsi</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($wilayah as $wilayah)
            <tr>
                <td>{{ $wilayah->nama_wilayah }}</td>
                <td>{{ $wilayah->latitude }}</td>
                <td>{{ $wilayah->longitude }}</td>
                <td>{{ $wilayah->deskripsi }}</td>
                <td>
                    <a href="{{ route('wilayah.edit', $wilayah->id_wilayah) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-danger" Mhs-bs-toggle="modal" Mhs-bs-target="#hapusModal{{ $mhs->nim }}">
                        Hapus
                    </button> --}}

                    <!-- Modal -->

                    <form action="{{route('wilayah.delete', $wilayah->id_wilayah)}}" method="post" class="d-inline">
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