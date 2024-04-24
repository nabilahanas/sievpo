@extends('layouts.main')

@section('title', 'Rekap Bulanan')

@section('content')
    <title>Rekap Bulanan</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('bulanan.exportkrph') }}?{{ request()->has('bulan') && request()->has('tahun') ? 'bulan=' . request()->bulan . '&tahun=' . request()->tahun : '' }}">Download
                    Excel</a>

                <div class="table-responsive-lg mt-4">
                    <table id="bkrph" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">

                        <thead class="thead-successv2">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama</th>
                                <th rowspan="2">Nama KRPH</th>
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
                            @endphp
                            @foreach ($jabatan1 as $item)
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

                                            $krphId = $item->id_user;
                                            $poin = isset($data[$krphId][$tanggal]) ? $data[$krphId][$tanggal] : 0;
                                            $total += $poin;
                                            $dailyTotals[$day] += $poin;
                                        @endphp
                                        <td>{{ $poin }}</td>
                                    @endfor

                                    <td>{{ $total }}</td>
                                </tr>
                                @php
                                    $grandTotal += $total;
                                @endphp
                            @endforeach
                        </tbody>
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
                <div class="table-responsive-lg mt-4">
                    <table id="bkrphpim" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">

                        <thead class="thead-successv2">
                            <tr>
                                <th>No.</th>
                                <th>Nama Karyawan</th>
                                <th>Nama KRPH</th>
                                <th>Total Poin</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedUsers = $jabatan1->sortByDesc(function ($item) use ($data, $request) {
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

                                        $krphId = $item->id_user;
                                        $poin = isset($data[$krphId][$tanggal]) ? $data[$krphId][$tanggal] : 0;
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

                                            $krphId = $item->id_user;
                                            $poin = isset($data[$krphId][$tanggal]) ? $data[$krphId][$tanggal] : 0;
                                            $total += $poin;
                                        }
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
