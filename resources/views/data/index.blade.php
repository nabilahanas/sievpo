@extends('layouts.main')

@section('title', 'Data Laporan Eviden')

@section('content')

<title>Data Laporan Eviden</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('data.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div class="card-body table-responsive">
                <table id="data" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>Nama</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <form action="{{ route('data.delete', $d->id_data) }}" method="post"
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