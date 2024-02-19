@extends('layouts.main')

@section('title', 'Data Karyawan')

@section('content')

    <title>Data Karyawan</title>

    <div class="card">
        <div class="card-body">
            <a href="" type="button" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="karyawan" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td></td>
                                <td>{{ $jabatan->nama_jabatan }}</td>
                                <td>
                                    @if ($jabatan->wilayah == 0)
                                        Wilayah Timur
                                    @elseif($jabatan->wilayah == 1)
                                        Wilayah Barat
                                    @endif
                                </td>
                                <td>
                                    <a href="" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen mr-2"></i>Ubah</a>

                                    <form action="" method="post"
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