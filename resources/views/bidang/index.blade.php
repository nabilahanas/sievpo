@extends('layouts.main')

@section('title', 'Data Bidang')

@section('content')
    <title>Data Bidang</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-check-circle mr-2" aria-hidden="true"></i></strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('bidang.add') }}" type="button" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</a>

            <div class="table-responsive mt-4">
                <table id="bidang" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama Bidang</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
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
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen mr-2"></i>Ubah</a>

                                    <form
                                        action="{{ $bidang->trashed() ? route('bidang.restore', $bidang->id_bidang) : route('bidang.delete', $bidang->id_bidang) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method($bidang->trashed() ? 'POST' : 'DELETE')
                                        <button type="submit"
                                            class="btn btn-sm {{ $bidang->trashed() ? 'btn-success' : 'btn-danger' }}">
                                            <i
                                                class="{{ $bidang->trashed() ? 'fas fa-check-circle' : 'fas fa-times-circle' }} mr-1"></i>
                                            {{ $bidang->trashed() ? 'Aktifkan' : 'Nonaktifkan' }}
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
