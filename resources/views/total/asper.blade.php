@extends('layouts.main')

@section('title', 'Rekap Total Asper/KBKPH')

@section('content')

    <title>Rekap Total Asper/KBKPH</title>

    <div class="tab-pane" id="asper">
        <a class="btn btn-outline-success" href="">Download Excel</a>
        <div class="table-responsive-lg mt-4">
            <table id="tasper" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                <thead class="thead-successv2">
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Nama Karyawan</th>
                        <th rowspan="2">Asper/KBKPH</th>
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
                    @foreach ($jabatan2 as $asper)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $asper->nama_user }}</td>
                            <td>{{ $asper->jabatan->nama_jabatan }}</td>
                            @foreach ($monthsToShow as $month)
                                @php
                                    $poin = isset($asperTotals[$asper->id_user][$month])
                                        ? $asperTotals[$asper->id_user][$month]
                                        : 0;
                                @endphp
                                <td>{{ $poin }}</td>
                            @endforeach
                            <td>
                                @php
                                    $asperTotal = isset($asperTotals[$asper->id_user])
                                        ? array_sum($asperTotals[$asper->id_user])
                                        : 0;
                                @endphp
                                {{ $asperTotal }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

@endsection