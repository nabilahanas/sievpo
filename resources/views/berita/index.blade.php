@extends('layouts.main')

@section('title', 'Data Berita')

@section('content')

    <title>Data Berita</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('berita.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div class="card-body table-responsive">
                <table id="berita" class="table table-sm table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>Tanggal Publikasi</th>
                            <th>Judul Berita</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($berita as $item)
                            <tr>
                                <td>{{ $item->tgl_publikasi }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/gambar-berita/'.$item->gambar)}}" alt="Gambar Berita" width="150">
                                    @else
                                        Tidak Ada Gambar
                                    @endif
                                </td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('berita.edit', $item->id_berita) }}" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen mr-2"></i>Ubah</a>
                                    <form action="{{ route('berita.delete', $item->id_berita) }}" method="post"
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
