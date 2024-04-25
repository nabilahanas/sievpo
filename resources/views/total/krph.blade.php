@extends('layouts.main')

@section('title', 'Rekap Total KRPH')

@section('content')

    <title>Rekap Total KRPH</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('total.exportkrph') }}?{{ request()->has('semester') && request()->has('year') ? 'semester=' . request()->semester . '&year=' . request()->year : 'search=' . '' }}">Download
                    Excel</a>
                <!-- Chart -->
                {{-- <div class="card">
                    <div class="card-body">
                        <div id="krphPoin" height="60"></div>
                    </div>
                </div> --}}
                <div class="table-responsive-lg mt-4">
                    @if (request()->has('semester') && request()->has('year'))
                        <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                            Hasil Pencarian Tahun {{ $currentYear }}
                        </div>
                    @endif
                    <table id="tkrph" class="table table-sm text-nowrap text-hover table-striped" style="width:100%">
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
                                $krphTotalsArray = []; // Inisialisasi array untuk menyimpan data $krphTotal
                            @endphp
                            @foreach ($jabatan1 as $krph)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $krph->nama_user }}</td>
                                    <td>{{ $krph->jabatan->nama_jabatan }}</td>
                                    @php
                                        $krphTotal = isset($krphTotals[$krph->id_user])
                                            ? array_sum($krphTotals[$krph->id_user])
                                            : 0;
                                        $krphTotalsArray[] = $krphTotal; // Tambahkan $krphTotal ke dalam array
                                    @endphp
                                    @foreach ($monthsToShow as $month)
                                        @php
                                            $poin = isset($krphTotals[$krph->id_user][$month])
                                                ? $krphTotals[$krph->id_user][$month]
                                                : 0;
                                            $monthlyTotals[$month] += $poin;
                                        @endphp
                                        <td>{{ $poin }}</td>
                                    @endforeach
                                    <td>{{ $krphTotal }}</td>
                                </tr>
                                @php
                                    $grandTotal += $krphTotal;
                                @endphp
                            @endforeach
                        </tbody>
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
                <div class="card">
                    <div class="card-body">
                        <div id="tKrphPim" height="60"></div>
                    </div>
                </div>
                <div class="table-responsive-lg mt-4">
                    <table id="tkrphpim" class="table table-sm text-nowrap text-hover table-striped" style="width: 100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th>No.</th>
                                <th>Nama Karyawan</th>
                                <th>Nama KRPH</th>
                                <th>Total Poin</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>

                        <tbody style="overflow-x: auto;">
                            @php
                                $monthsToShow = [];
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedKRPH = $jabatan1->sortByDesc(function ($krph) use ($krphTotals) {
                                    return isset($krphTotals[$krph->id_user])
                                        ? array_sum($krphTotals[$krph->id_user])
                                        : 0;
                                });

                                // Menginisialisasi peringkat
                                $ranking = 1;

                                $pieData = [];
                                foreach ($sortedKRPH as $krph) {
                                    $krphTotal = isset($krphTotals[$krph->id_user])
                                        ? array_sum($krphTotals[$krph->id_user])
                                        : 0;
                                    $pieData[] = ['name' => $krph->nama_user, 'y' => $krphTotal];
                                }
                            @endphp

                            @foreach ($sortedKRPH as $krph)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $krph->nama_user }}</td>
                                    <td>{{ $krph->jabatan->nama_jabatan }}</td>
                                    <td>
                                        @php
                                            $krphTotal = isset($krphTotals[$krph->id_user])
                                                ? array_sum($krphTotals[$krph->id_user])
                                                : 0;
                                        @endphp
                                        {{ $krphTotal }}
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
    {{-- @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <script>
            Highcharts.chart('krphPoin', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafik Eviden Poin KRPH',
                    align: 'center'
                },
                xAxis: {
                    categories: {!! json_encode($categories) !!},
                    crosshair: true,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Poin'
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Poin',
                    data: {!! json_encode($krphTotalsArray) !!} // Gunakan data array yang berisi $krphTotal
                }]
            });
        </script>
    @endif --}}

    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <script>
            var currentYear = "<?php echo $currentYear; ?>";
            Highcharts.chart('tKrphPim', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Ranking KRPH ' + currentYear,
                    align: 'left',
                    style: {
                        color: '#007bff'
                    }
                },
                series: [{
                    name: 'Poin',
                    colorByPoint: true,
                    data: {!! json_encode($pieData) !!}
                }]
            });
        </script>
    @endif
@endsection
