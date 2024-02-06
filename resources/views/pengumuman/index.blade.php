@extends('layouts.main')

@section('content')

<h4 class="mt-5">Data Pengumuman</h4>

<a href="{{ route('pengumuman.add') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Judul Pengumuman</th>
        <th>Gambar</th>
        <th>Deskripsi</th>
        <th>Tanggal Publikasi</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($pengumuman as $pengumuman)
            <tr>
                <td>{{ $pengumuman->judul }}</td>
                <td>
                    <a href="{{ route('pengumuman.edit', $pengumuman->id_pengumuman) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <form action="{{route('pengumuman.delete', $pengumuman->id_pengumuman)}}" method="post" class="d-inline">
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