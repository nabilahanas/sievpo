@extends('layouts.main')

@section('title', 'Rekap Bulanan Karyawan')

@section('content')
    <title>Rekap Bulanan Karyawan</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('bulanan.exportkaryawan') }}?{{ request()->has('bulan') && request()->has('tahun') ? 'bulan=' . request()->bulan . '&tahun=' . request()->tahun : '' }}">Download
                    Excel</a>
                <div class="card mt-4">
                    <div class="card-body">
                        <div id="bKarAd" height="60"></div>
                    </div>
                </div>

                <div class="table-responsive-lg mt-4">
                    <div class="table-responsive-lg mt-4">
                        @if (request()->has('bulan') && request()->has('tahun'))
                            <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                                Hasil Pencarian: {{ $currentMonth }}
                            </div>
                        @endif
                        <table id="bulanan" class="table table-sm text-nowrap text-hover table-striped"
                            style="width: 100%">

                            <thead class="thead-successv2">
                                <tr>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Jabatan</th>
                                    <th rowspan="2">Wilayah</th>
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
                                    $usersData = []; // Array untuk menyimpan data pengguna dengan total mereka
                                @endphp
                                @foreach ($users as $user)
                                    @php
                                        $total = 0;
                                    @endphp

                                    <tr>
                                        <td>{{ $user->nama_user }}</td>
                                        <td>{{ $user->jabatan->nama_jabatan }}</td>
                                        <td>
                                            @if ($user->jabatan->wilayah == 0)
                                                WILAYAH TIMUR
                                            @elseif($user->jabatan->wilayah == 1)
                                                WILAYAH BARAT
                                            @endif
                                        </td>
                                        @for ($day = 1; $day <= $daysInMonth; $day++)
                                            @php
                                                $tanggal =
                                                    isset($request->tahun) && isset($request->bulan)
                                                        ? Carbon\Carbon::createFromDate(
                                                            $request->tahun,
                                                            $request->bulan,
                                                            $day,
                                                        )->format('d-m-Y')
                                                        : Carbon\Carbon::createFromDate(
                                                            date('Y'),
                                                            date('m'),
                                                            $day,
                                                        )->format('d-m-Y');

                                                $userId = $user->id_user;
                                                $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                                $total += $poin;
                                                $dailyTotals[$day] += $poin;
                                            @endphp
                                            <td>{{ $poin }}</td>
                                        @endfor

                                        <td>{{ $total }}</td>
                                    </tr>
                                    @php
                                        $grandTotal += $total;
                                        $user->total = $total; // Assign total to the user object for use in JavaScript
                                        // Menyimpan data pengguna dan total mereka ke dalam array
                                        $usersData[] = ['nama_user' => $user->nama_user, 'total' => $total];
                                    @endphp
                                @endforeach
                            </tbody>

                            @php
                                // Urutkan array pengguna berdasarkan total mereka secara menurun
                                usort($usersData, function ($a, $b) {
                                    return $b['total'] - $a['total'];
                                });
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
        </div>
    @endif

    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div id="bKaryawanPim" height="60"></div>
                    </div>
                </div>
                <div class="table-responsive-lg mt-4">
                    @if (request()->has('bulan') && request()->has('tahun'))
                        <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                            Hasil Pencarian: {{ $currentMonth }}
                        </div>
                    @endif
                    <table id="bkaryawanpim" class="table table-sm text-nowrap text-hover table-striped"
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
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedUsers = $users->sortByDesc(function ($user) use ($data, $request) {
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

                                        $userId = $user->id_user;
                                        $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                        $total += $poin;
                                    }
                                    return $total;
                                });

                                // Menginisialisasi peringkat
                                $ranking = 1;
                                // Menyiapkan data untuk grafik pie
                                $pieData = [];

                                foreach ($sortedUsers as $user) {
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

                                        $userId = $user->id_user;
                                        $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                        $total += $poin;
                                    }
                                    // Menambahkan data ke array pieData
                                    $pieData[] = ['name' => $user->nama_user, 'y' => $total];
                                }
                            @endphp

                            @foreach ($sortedUsers as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $user->nama_user }}</td>
                                    <td>{{ $user->jabatan->nama_jabatan }}</td>
                                    @php
                                        // Total poin untuk pengguna saat ini
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

                                            $userId = $user->id_user;
                                            $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                            $total += $poin;
                                        }
                                    @endphp
                                    <td>{{ $total }}</td>
                                    <td>{{ $ranking }}</td>
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
    <!-- ADMIN -->
    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <script>
            var currentMonth = "<?php echo $currentMonth; ?>";
            Highcharts.chart('bKarAd', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rekap Karyawan ' + currentMonth,
                    align: 'center',
                    style: {
                        color: '#007bff'
                    }
                },
                xAxis: {
                    categories: [
                        @foreach ($usersData as $userData)
                            '{{ $userData['nama_user'] }}',
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
                    data: [
                        @foreach ($usersData as $userData)
                            {{ $userData['total'] }},
                        @endforeach
                    ]
                }]
            });
        </script>
    @endif

    <!-- PIMPINAN -->
    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <script>
            var currentMonth = "<?php echo $currentMonth; ?>";
            Highcharts.chart('bKaryawanPim', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Ranking Karyawan ' + currentMonth,
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