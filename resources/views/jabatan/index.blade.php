@extends('layouts.main')

@section('title', 'Data Jabatan')

@section('content')

    <title>Data Jabatan</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('jabatan.add') }}" type="button" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="jabatan" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
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
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen mr-2"></i>Ubah</a>

                                    <form action="{{ route('jabatan.delete', $jabatan->id_jabatan) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('POST')
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