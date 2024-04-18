@extends('total.page')

@section('title', 'Rekap Total BKPH')

@section('tab_content')

    <title>Rekap Total BKPH</title>

    {{-- <div class="tab-pane" id="bkph"> --}}
    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success" href="">Download Excel</a>
            <div class="table-responsive-lg mt-4">
                <table id="tbkph" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Nama BKPH</th>
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
                        @foreach ($jabatan as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->bagian }}</td>

                                @foreach ($monthsToShow as $month)
                                    @php
                                        $poin = isset($bkphTotals[$item->bagian][$month])
                                            ? $bkphTotals[$item->bagian][$month]
                                            : 0;
                                    @endphp
                                    <td>{{ $poin }}</td>
                                @endforeach
                                <td>
                                    @php
                                        $bkphTotal = isset($bkphTotals[$item->bagian])
                                            ? array_sum($bkphTotals[$item->bagian])
                                            : 0;
                                    @endphp
                                    {{ $bkphTotal }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection
