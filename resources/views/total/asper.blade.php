@extends('layouts.main')

@section('title', 'Rekap Total Asper/KBKPH')

@section('content')

    <title>Rekap Total Asper/KBKPH</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card-body">
            <a class="btn btn-outline-success"
                href="{{ route('total.exportasper') }}?{{ request()->has('semester') && request()->has('year') ? 'semester=' . request()->semester . '&year=' . request()->year : 'search=' . '' }}">Download
                Excel</a>
            <!-- Chart -->
            <div class="card mt-4">
                <div class="card-body">
                    <div id="tAsperAd"></div>
                </div>
            </div>
            <!-- Table -->
            <div class="table-responsive-lg mt-4">
                <div class="table-responsive-lg mt-4">
                    @if (request()->has('semester') && request()->has('year'))
                        <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                            Hasil Pencarian Semester {{ $request->semester }} Tahun {{ $currentYear }}
                        </div>
                    @endif
                    <table id="tasper" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama Karyawan</th>
                                <th rowspan="2">Nama BKPH</th>
                                @php
                                    $monthsToShow = [];
                                    if ($request->has('semester') && $request->has('year')) {
                                        $semester = $request->semester;
                                        $monthsToShow =
                                            $semester == 1
                                                ? ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni']
                                                : ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    } else {
                                        $monthsToShow = [
                                            'Januari',
                                            'Februari',
                                            'Maret',
                                            'April',
                                            'Mei',
                                            'Juni',
                                            'Juli',
                                            'Agustus',
                                            'September',
                                            'Oktober',
                                            'November',
                                            'Desember',
                                        ];
                                    }
                                @endphp
                                <th colspan="{{ count($monthsToShow) }}" style="text-align: center">{{ $currentYear }}
                                </th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                @if ($request->has('semester') && $request->has('year'))
                                    @php
                                        $semester = $request->semester;
                                        $monthsToShow =
                                            $semester == 01
                                                ? ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni']
                                                : ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    @endphp
                                    @foreach ($monthsToShow as $monthName)
                                        <th>{{ $monthName }}</th>
                                    @endforeach
                                @else
                                    @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $monthName)
                                        <th>{{ $monthName }}</th>
                                    @endforeach
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $grandTotal = 0;
                                $monthlyTotals = array_fill_keys($monthsToShow, 0);
                                $asperData = [];
                            @endphp
                            @foreach ($jabatan2 as $asper)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $asper->nama_user }}</td>
                                    <td>{{ $asper->jabatan->nama_jabatan }}</td>
                                    @foreach ($monthsToShow as $month)
                                        @php
                                            $poin = isset($asperTotals[$asper->id_user][$month])
                                                ? $asperTotals[$asper->id_user][$month]
                                                : 0;
                                            $monthlyTotals[$month] += $poin;
                                        @endphp
                                        <td>{{ $poin }}</td>
                                    @endforeach
                                    <td>
                                        @php
                                            $asperTotal = isset($asperTotals[$asper->id_user])
                                                ? array_sum($asperTotals[$asper->id_user])
                                                : 0;
                                            $asper->total = $asperTotal;
                                        @endphp
                                        {{ $asperTotal }}
                                    </td>
                                </tr>
                                @php
                                    $grandTotal += $asperTotal;
                                    $asperData[] = ['nama_user' => $asper->nama_user, 'total' => $asperTotal];
                                @endphp
                            @endforeach
                        </tbody>
                        @php
                            $asperData = collect($asperData)->sortByDesc('total')->values();
                        @endphp
                        <tfoot>
                            <tr>
                                <th colspan="3" style="text-align:right">Total:</th>
                                @foreach ($monthlyTotals as $monthlyTotal)
                                    <th>{{ $monthlyTotal }}</th>
                                @endforeach
                                <th>{{ $grandTotal }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <div class="card">
            <div class="card-body">
                <!-- Chart -->
                <div class="card">
                    <div class="card-body">
                        <div id="tAsperPim" height="60"></div>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive-lg mt-4">
                    @if (request()->has('semester') && request()->has('year'))
                        <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                            Hasil Pencarian Semester {{ $request->semester }} Tahun {{ $currentYear }}
                        </div>
                    @endif
                    <table id="tasperpim" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th>No.</th>
                                <th>Nama Karyawan</th>
                                <th>Nama BKPH</th>
                                <th>Total Poin</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $monthsToShow = [];
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedAsper = $jabatan2->sortByDesc(function ($asper) use ($asperTotals) {
                                    return isset($asperTotals[$asper->id_user])
                                        ? array_sum($asperTotals[$asper->id_user])
                                        : 0;
                                });

                                // Menginisialisasi peringkat
                                $ranking = 1;
                            @endphp

                            @foreach ($sortedAsper as $asper)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $asper->nama_user }}</td>
                                    <td>{{ $asper->jabatan->nama_jabatan }}</td>
                                    <td>
                                        @php
                                            $asperTotal = isset($asperTotals[$asper->id_user])
                                                ? array_sum($asperTotals[$asper->id_user])
                                                : 0;
                                            $asper->total = $asperTotal;
                                        @endphp
                                        {{ $asperTotal }}
                                    </td>
                                    <td> {{ $ranking }} </td>
                                </tr>
                                @php
                                    $ranking++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <!-- ADMIN-->
    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <script>
            var currentYear = "{{ $currentYear }}";
            Highcharts.chart('tAsperAd', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rekap Asper/KBKPH' + currentYear,
                    align: 'center',
                    style: {
                        color: '#007bff'
                    }
                },
                xAxis: {
                    categories: [
                        @foreach ($asperData as $asper)
                            '{{ $asper['nama_user'] }}',
                        @endforeach
                    ],
                    crosshair: true,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Poin'
                    }
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Total Poin',
                    data: [
                        @foreach ($asperData as $asper)
                            {{ $asper['total'] }},
                        @endforeach
                    ]
                }]
            });
        </script>
    @endif

    <!-- PIMPINAN -->
    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <script>
            var currentYear = "<?php echo $currentYear; ?>";
            Highcharts.chart('tAsperPim', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rekap Asper/KBKPH ' + currentYear,
                    align: 'center',
                    style: {
                        color: '#007bff'
                    }
                },
                xAxis: {
                    categories: [
                        @foreach ($sortedAsper as $user)
                            '{{ $user->nama_user }}',
                        @endforeach
                    ],
                    crosshair: true,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Poin'
                    }
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Total Poin',
                    data: [
                        @foreach ($sortedAsper as $user)
                            {{ $user->total }},
                        @endforeach
                    ]
                }]
            });
        </script>
    @endif
@endsection
