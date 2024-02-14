@extends('layouts.main')

@section('title', 'Data Shift')

@section('content')

    <title>Data Shift</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('shift.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="shift" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama Shift</th>
                            <th>Jam Mulai</th>
                            <th>Jam Akhir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shift as $shift)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $shift->nama_shift }}</td>
                                <td>{{ $shift->jam_mulai }}</td>
                                <td>{{ $shift->jam_akhir }}</td>
                                <td>
                                    {{-- <a href="{{ route('shift.edit', $shift->id_shift) }}" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen"></i> Ubah</a> --}}

                                    <form action="{{ route('shift.delete', $shift->id_shift) }}" method="post"
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
