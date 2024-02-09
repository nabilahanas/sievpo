@extends('layouts.main')

@section('title', 'Data Jabatan')

@section('content')

    <title>Data Jabatan</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('jabatan.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="jabatan" class="table table-sm text-nowrap table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Jabatan</th>
                            <th>Wilayah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jabatan as $jabatan)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $jabatan->nama_jabatan }}</td>
                                <td>
                                    @if ($jabatan->wilayah == 0)
                                        Wilayah Timur
                                    @elseif($jabatan->wilayah == 1)
                                        Wilayah Barat
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('jabatan.edit', $jabatan->id_jabatan) }}" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen"></i> Ubah</a>

                                    <form action="{{ route('jabatan.delete', $jabatan->id_jabatan) }}" method="post"
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
