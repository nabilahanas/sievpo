@extends('layouts.main')

@section('title', 'Data Lokasi')

@section('content')

    <title>Data Lokasi</title>

    <div class="card">
        <div class="card-body">

            <a href="{{ route('lokasi.add') }}" type="button" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="lokasi" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama Lokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Aksi</th>
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
                                    {{-- <a href="{{ route('lokasi.edit', $lokasi->id_lokasi) }}" type="button"
                                        class="btn btn-sm btn-warning rounded-3"><i class="fas fa-pen mr-2"></i>Ubah</a> --}}

                                    <form action="{{ route('lokasi.delete', $lokasi->id_lokasi) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i
                                                class="fas fa-trash mr-2"></i>Hapus</button>
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