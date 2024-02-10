@extends('layouts.main')

@section('title', 'Data Wilayah')

@section('content')

    <title>Data Wilayah</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('wilayah.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
            <table id="wilayah" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                <thead class="thead-successv2">
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
                                <a href="{{ route('wilayah.edit', $wilayah->id_wilayah) }}" type="button"
                                    class="btn btn-warning rounded-3"><i class="fas fa-pen"></i> Ubah</a>
                                <form action="{{ route('wilayah.delete', $wilayah->id_wilayah) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> 
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection