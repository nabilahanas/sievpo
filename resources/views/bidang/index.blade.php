@extends('layouts.main')

@section('title', 'Data Bidang')

@section('content')

    <title>Data Bidang</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('bidang.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="bidang" class="table table-sm text-nowrap table-hover" style="width: 100%">
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
                                    <a href="{{ route('bidang.edit', $bidang->id_bidang) }}" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen"></i> Ubah</a>

                                    <form action="{{ route('bidang.delete', $bidang->id_bidang) }}" method="post"
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
