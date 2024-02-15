@extends('layouts.main')

@section('title', 'Data Pengumuman')

@section('content')

    <title>Data Pengumuman</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('pengumuman.add') }}" type="button" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="pengumuman" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>Judul Pengumuman</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Publikasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengumuman as $item)
                            <tr>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/gambar-pengumuman/'.$item->gambar)}}" alt="Gambar Pengumuman" width="150">
                                    @else
                                        Tidak Ada Gambar
                                    @endif
                                </td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->tgl_publikasi }}</td>
                                <td>
                                    <a href="{{ route('pengumuman.edit', $item->id_pengumuman) }}" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen mr-2"></i>Ubah</a>
                                    <form action="{{ route('pengumuman.delete', $item->id_pengumuman) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash mr-2"></i>Hapus</button>
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