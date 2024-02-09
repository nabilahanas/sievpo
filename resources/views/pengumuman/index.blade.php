@extends('layouts.main')

@section('title', 'Data Pengumuman')

@section('content')

    <title>Data Pengumuman</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('pengumuman.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="pengumuman" class="table table-sm text-nowrap table-hover" style="width: 100%">
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
                                    <a href="{{ route('pengumuman.edit', $pengumuman->id_pengumuman) }}" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen"></i> Ubah</a>

                                    <form action="{{ route('pengumuman.delete', $pengumuman->id_pengumuman) }}"
                                        method="post" class="d-inline">
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
