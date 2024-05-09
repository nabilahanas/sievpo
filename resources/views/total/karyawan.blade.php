@extends('layouts.main')

@section('title', 'Rekap Total Karyawan')

@section('content')

    <title>Rekap Total Karyawan</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('total.exportkaryawan') }}?{{ request()->has('semester') && request()->has('year') ? 'semester=' . request()->semester . '&year=' . request()->year : 'search=' . '' }}">Download
                    Excel</a>
                <!-- Chart -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div id="tKarAd"></div>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive-lg mt-4">
                    @if (request()->has('semester') && request()->has('year'))
                        <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                            Hasil Pencarian Tahun {{ $currentYear }}
                        </div>
                    @endif
                    <table id="tkaryawan" class="table table-sm text-nowrap text-hover table-striped" style="width:100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama</th>
                                <th rowspan="2">Wilayah</th>
                                @php
                                    $monthsToShow = [];
                                    if (request()->has('semester') && request()->has('year')) {
                                        $semester = request()->semester;
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
                                <th colspan="{{ count($monthsToShow) }}" style="text-align: center">{{ $currentYear }}</th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                @if (request()->has('semester') && request()->has('year'))
                                    @php
                                        $semester = request()->semester;
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
                                $usersData = [];
                            @endphp
                            @foreach ($user as $UItem)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $UItem->nama_user }}</td>
                                    <td>
                                        @if ($UItem->jabatan->wilayah == 0)
                                            WILAYAH TIMUR
                                        @elseif($UItem->jabatan->wilayah == 1)
                                            WILAYAH BARAT
                                        @endif
                                    </td>
                                    @foreach ($monthsToShow as $month)
                                        @php
                                            $poin = isset($karyawanTotals[$UItem->id_user][$month])
                                                ? $karyawanTotals[$UItem->id_user][$month]
                                                : 0;
                                            $monthlyTotals[$month] += $poin;
                                        @endphp
                                        <td>{{ $poin }}</td>
                                    @endforeach
                                    <td>
                                        @php
                                            $userTotal = isset($karyawanTotals[$UItem->id_user])
                                                ? array_sum($karyawanTotals[$UItem->id_user])
                                                : 0;
                                            $UItem->total = $userTotal;
                                        @endphp
                                        {{ $userTotal }}
                                    </td>
                                </tr>
                                @php
                                    $grandTotal += $userTotal;
                                    $usersData[] = ['nama_user' => $UItem->nama_user, 'total' => $userTotal];
                                @endphp
                            @endforeach
                        </tbody>
                        @php
                            $totalPoints = isset($karyawanTotals[auth()->user()->id_user])
                                ? array_values($karyawanTotals[auth()->user()->id_user])
                                : [];
                            // Urutkan array pengguna berdasarkan total mereka secara menurun
                            usort($usersData, function ($a, $b) {
                                return $b['total'] - $a['total'];
                            });
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
                        <div id="tKaryawanPim" height="60"></div>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive mt-4">
                    <table id="tkaryawanpim" class="table table-sm text-nowrap text-hover table-striped"
                        style="width: 100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th>No.</th>
                                <th>Nama Karyawan</th>
                                <th>Nama Jabatan</th>
                                <th>Total Poin</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $monthsToShow = [];
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedUsers = $user->sortByDesc(function ($UItem) use ($karyawanTotals) {
                                    return isset($karyawanTotals[$UItem->id_user])
                                        ? array_sum($karyawanTotals[$UItem->id_user])
                                        : 0;
                                });

                                // Menginisialisasi peringkat
                                $ranking = 1;
                            @endphp

                            @foreach ($sortedUsers as $UItem)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $UItem->nama_user }}</td>
                                    <td>{{ $UItem->jabatan->nama_jabatan }}</td>
                                    <td>
                                        @php
                                            $userTotal = isset($karyawanTotals[$UItem->id_user])
                                                ? array_sum($karyawanTotals[$UItem->id_user])
                                                : 0;
                                            $UItem->total = $userTotal;
                                        @endphp
                                        {{ $userTotal }}
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

    <!-- ADMIN -->
    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <script>
            var currentYear = "{{ $currentYear }}";
            Highcharts.chart('tKarAd', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rekap Karyawan ' + currentYear,
                    align: 'center',
                    style: {
                        color: '#007bff'
                    }
                },
                xAxis: {
                    categories: [
                        @foreach ($usersData as $UItem)
                            '{{ $UItem['nama_user'] }}',
                        @endforeach
                    ],
                    crosshair: true,
                    labels: {
                        rotation: -60,
                    }
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
                        @foreach ($usersData as $UItem)
                            {{ $UItem['total'] }},
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
            Highcharts.chart('tKaryawanPim', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rekap Karyawan ' + currentYear,
                    align: 'center',
                    style: {
                        color: '#007bff'
                    }
                },
                xAxis: {
                    categories: [
                        @foreach ($sortedUsers as $user)
                            '{{ $user->nama_user }}',
                        @endforeach
                    ],
                    crosshair: true,
                    labels: {
                        rotation: -60,
                    }
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
                        @foreach ($sortedUsers as $user)
                            {{ $user->total }},
                        @endforeach
                    ]
                }]
            });
        </script>
    @endif
@endsection
