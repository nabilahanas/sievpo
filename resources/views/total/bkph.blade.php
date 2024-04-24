@extends('layouts.main')

@section('title', 'Rekap Total BKPH')

@section('content')

    <title>Rekap Total BKPH</title>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive-lg mt-4">
                <table id="tbkphpim" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama BKPH</th>
                            <th>Total Poin</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($jabatan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $item->bagian }}</td>
                                <td></td>
                                <td></td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
