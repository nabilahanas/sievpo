@extends('layouts.main')

@section('title', 'Data Berita')

@section('content')

    <title>Data Berita</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('berita.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div class="card-body table-responsive">
                <table id="berita" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>Judul Berita</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Publikasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($berita as $berita)
                            <tr>
                                <td>{{ $berita->judul }}</td>
                                <td>
                                    <a href="{{ route('berita.edit', $berita->id_berita) }}" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen"></i> Ubah</a>

                                    <form action="{{ route('berita.delete', $berita->id_berita) }}" method="post"
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
