@extends('layouts.main')

@section('content')

<h4 class="mt-5">Data Shift</h4>

<a href="{{ route('shift.add') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
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
                    <a href="{{ route('shift.edit', $shift->id_shift) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <form action="{{route('shift.delete', $shift->id_shift)}}" method="post" class="d-inline">
                        @csrf
                        @method('POST')
                        <button class="btn btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection