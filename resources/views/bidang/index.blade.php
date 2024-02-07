@extends('layouts.main')

@section('content')

<h4 class="mt-0">Data Bidang</h4>

<a href="{{ route('bidang.add') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Bidang</th>
        <th>Deskripsi</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($bidang as $bidang)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $bidang->nama_bidang }}</td>
                <td>{{ $bidang->deskripsi }}</td>
                <td>
                    <a href="{{ route('bidang.edit', $bidang->id_bidang) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <form action="{{route('bidang.delete', $bidang->id_bidang)}}" method="post" class="d-inline">
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