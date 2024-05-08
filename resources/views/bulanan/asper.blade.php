@extends('layouts.main')

@section('title', 'Rekap Bulanan Asper/KBKPH')

@section('content')
    <title>Rekap Bulanan Asper/KBKPH</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('bulanan.exportasper') }}?{{ request()->has('bulan') && request()->has('tahun') ? 'bulan=' . request()->bulan . '&tahun=' . request()->tahun : '' }}">Download
                    Excel</a>

                <div class="card mt-4">
                    <div class="card-body">
                        <div id="bAsperAd" height="60"></div>
                    </div>
                </div>

                <div class="table-responsive-lg mt-4">
                    @if (request()->has('bulan') && request()->has('tahun'))
                        <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                            Hasil Pencarian: {{ $currentMonth }}
                        </div>
                    @endif
                    <table id="basper" class="table table-sm text-nowrap text-hover table-striped" style="width:100%">

                        <thead class="thead-successv2">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama Karyawan</th>
                                <th rowspan="2">Nama BKPH</th>
                                @php
                                    $daysInMonth =
                                        $request->has('bulan') && $request->has('tahun')
                                            ? Carbon\Carbon::create($request->tahun, $request->bulan)->daysInMonth
                                            : Carbon\Carbon::now()->daysInMonth;
                                    $colspan = $daysInMonth; // 3 kolom pertama untuk Nama, Jabatan, dan Wilayah
                                @endphp
                                <th colspan="{{ $colspan }}" class="text-center">{{ $currentMonth }}</th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                @php
                                    $daysInMonth =
                                        $request->has('bulan') && $request->has('tahun')
                                            ? Carbon\Carbon::create($request->tahun, $request->bulan)->daysInMonth
                                            : Carbon\Carbon::now()->daysInMonth;
                                @endphp
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <th>{{ $day }}</th>
                                @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $grandTotal = 0;
                                $dailyTotals = array_fill(1, $daysInMonth, 0);
                                $jabatanTotals = [];
                            @endphp
                            @foreach ($jabatan2 as $item)
                                @php
                                    $total = 0;
                                @endphp

                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $item->nama_user }}</td>
                                    <td>{{ $item->jabatan->nama_jabatan }}</td>
                                    @for ($day = 1; $day <= $daysInMonth; $day++)
                                        @php
                                            $tanggal =
                                                isset($request->tahun) && isset($request->bulan)
                                                    ? Carbon\Carbon::createFromDate(
                                                        $request->tahun,
                                                        $request->bulan,
                                                        $day,
                                                    )->format('d-m-Y')
                                                    : Carbon\Carbon::createFromDate(date('Y'), date('m'), $day)->format(
                                                        'd-m-Y',
                                                    );

                                            $userId = $item->id_user;
                                            $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                            $total += $poin;
                                            $dailyTotals[$day] += $poin;
                                        @endphp
                                        <td>{{ $poin }}</td>
                                    @endfor

                                    <td>{{ $total }}</td>
                                </tr>
                                @php
                                    $jabatanTotals[] = $total;
                                    $grandTotal += $total;
                                @endphp
                            @endforeach
                        </tbody>
                        @php
                            // Buat array asosiatif untuk menyimpan total poin bidang dengan nama pengguna sebagai kunci
                            $jabatanTotalsAssoc = [];
                            foreach ($jabatan2 as $index => $item) {
                                $jabatanTotalsAssoc[$item->nama_user] = $jabatanTotals[$index];
                            }

                            // Urutkan array asosiatif berdasarkan nilai total poin bidang secara menurun
                            arsort($jabatanTotalsAssoc);
                        @endphp


                        <tfoot>
                            <tr>
                                <th colspan="3" style="text-align:right">Total:</th>
                                @foreach ($dailyTotals as $dailyTotal)
                                    <th>{{ $dailyTotal }}</th>
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
                        <div id="bAsperPim" height="60"></div>
                    </div>
                </div>
                <div class="table-responsive-lg mt-4">
                    @if (request()->has('bulan') && request()->has('tahun'))
                        <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                            Hasil Pencarian: {{ $currentMonth }}
                        </div>
                    @endif
                    <table id="basper" class="table table-sm text-nowrap text-hover table-striped" style="width: 100%">

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
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedUsers = $jabatan2->sortByDesc(function ($item) use ($data, $request) {
                                    $total = 0;
                                    $daysInMonth =
                                        $request->has('bulan') && $request->has('tahun')
                                            ? Carbon\Carbon::create($request->tahun, $request->bulan)->daysInMonth
                                            : Carbon\Carbon::now()->daysInMonth;

                                    for ($day = 1; $day <= $daysInMonth; $day++) {
                                        $tanggal =
                                            isset($request->tahun) && isset($request->bulan)
                                                ? Carbon\Carbon::createFromDate(
                                                    $request->tahun,
                                                    $request->bulan,
                                                    $day,
                                                )->format('d-m-Y')
                                                : Carbon\Carbon::createFromDate(date('Y'), date('m'), $day)->format(
                                                    'd-m-Y',
                                                );

                                        $userId = $item->id_user;
                                        $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                        $total += $poin;
                                    }
                                    return $total;
                                });

                                // Menginisialisasi peringkat
                                $ranking = 1;
                            @endphp

                            @foreach ($sortedUsers as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $item->nama_user }}</td>
                                    <td>{{ $item->jabatan->nama_jabatan }}</td>

                                    @php
                                        $total = 0;
                                        $daysInMonth =
                                            $request->has('bulan') && $request->has('tahun')
                                                ? Carbon\Carbon::create($request->tahun, $request->bulan)->daysInMonth
                                                : Carbon\Carbon::now()->daysInMonth;

                                        for ($day = 1; $day <= $daysInMonth; $day++) {
                                            $tanggal =
                                                isset($request->tahun) && isset($request->bulan)
                                                    ? Carbon\Carbon::createFromDate(
                                                        $request->tahun,
                                                        $request->bulan,
                                                        $day,
                                                    )->format('d-m-Y')
                                                    : Carbon\Carbon::createFromDate(date('Y'), date('m'), $day)->format(
                                                        'd-m-Y',
                                                    );

                                            $userId = $item->id_user;
                                            $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                            $total += $poin;
                                        }
                                        $item->total = $total;
                                    @endphp
                                    <td>{{ $total }}</td>
                                    <!-- Menampilkan peringkat berdasarkan urutan data yang sudah diurutkan -->
                                    <td>{{ $ranking }}</td>
                                </tr>
                                @php
                                    // Meningkatkan peringkat setiap kali perulangan selesai
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
            var currentMonth = "<?php echo $currentMonth; ?>";
            Highcharts.chart('bAsperAd', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rekap Asper/KBKPH ' + currentMonth,
                    align: 'center',
                    style: {
                        color: '#007bff'
                    }
                },
                xAxis: {
                    categories: [
                        @foreach ($jabatanTotalsAssoc as $namaUser => $totalPoin)
                            '{{ $namaUser }}',
                        @endforeach
                    ],
                    crosshair: true,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Poin'
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
                    name: 'Poin',
                    data: {!! json_encode(array_values($jabatanTotalsAssoc)) !!}
                }]
            });
        </script>
    @endif

    <!-- PIMPINAN -->
    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <script>
            var currentMonth = "<?php echo $currentMonth; ?>";
            Highcharts.chart('bAsperPim', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Ranking KRPH ' + currentMonth,
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
                            {{ $user->total }}, // Assuming you have a 'total' property for each user
                        @endforeach
                    ]
                }]
            });
        </script>
    @endif
@endsection
