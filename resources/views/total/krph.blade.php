@extends('layouts.main')

@section('title', 'Rekap Total KRPH')

@section('content')

    <title>Rekap Total KRPH</title>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success" href="">Download Excel</a>
            <div class="table-responsive-lg mt-4">
                <table id="tkrph" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Nama KRPH</th>
                            @php
                                $monthsToShow = [];
                                if ($request->has('semester') && $request->has('year')) {
                                    $semester = $request->semester;
                                    $monthsToShow =
                                        $semester == 1
                                            ? ['January', 'February', 'March', 'April', 'May', 'June']
                                            : ['July', 'August', 'September', 'October', 'November', 'December'];
                                } else {
                                    $monthsToShow = [
                                        'January',
                                        'February',
                                        'March',
                                        'April',
                                        'May',
                                        'June',
                                        'July',
                                        'August',
                                        'September',
                                        'October',
                                        'November',
                                        'December',
                                    ];
                                }
                            @endphp
                            <th colspan="{{ count($monthsToShow) }}" style="text-align: center">{{ $currentYear }}</th>
                            <th rowspan="2">Total</th>
                        </tr>
                        <tr>
                            @if ($request->has('semester') && $request->has('year'))
                                @php
                                    $semester = $request->semester;
                                    $monthsToShow =
                                        $semester == 01
                                            ? ['January', 'February', 'March', 'April', 'May', 'June']
                                            : ['July', 'August', 'September', 'October', 'November', 'December'];
                                @endphp
                                @foreach ($monthsToShow as $monthName)
                                    <th>{{ $monthName }}</th>
                                @endforeach
                            @else
                                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                    <th>{{ $monthName }}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($jabatan1 as $krph)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $krph->nama_user }}</td>
                                <td>{{ $krph->jabatan->nama_jabatan }}</td>
                                @foreach ($monthsToShow as $month)
                                    @php
                                        $poin = isset($krphTotals[$krph->id_user][$month])
                                            ? $krphTotals[$krph->id_user][$month]
                                            : 0;
                                    @endphp
                                    <td>{{ $poin }}</td>
                                @endforeach
                                <td>
                                    @php
                                        $krphTotal = isset($krphTotals[$krph->id_user])
                                            ? array_sum($krphTotals[$krph->id_user])
                                            : 0;
                                    @endphp
                                    {{ $krphTotal }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="15" style="text-align:right">Total:</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection
