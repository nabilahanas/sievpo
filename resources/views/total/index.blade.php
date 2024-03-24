@extends('layouts.main')

@section('title', 'Rekap Total')

@section('content')
    <title>Rekap Total</title>

    <!-- ADMIN -->
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" href="#karyawan" data-toggle="tab">Rekap Karyawan</a></li>
                <li class="nav-item"><a class="nav-link" href="#bidang" data-toggle="tab">Rekap Bidang</a></li>
                <li class="nav-item"><a class="nav-link" href="#bkph" data-toggle="tab">Rekap BKPH</a></li>
                <li class="nav-item"><a class="nav-link" href="#krph" data-toggle="tab">Rekap KRPH</a></li>
                <li class="nav-item"><a class="nav-link" href="#asper" data-toggle="tab">Rekap Asper/KBKPH</a></li>
            </ul>
            <div class="mt-4">
                <div class="tab-content">

                    <!-- KARYAWAN -->
                    <div class="active tab-pane" id="karyawan">
                        <a class="btn btn-outline-success" href="">Download
                            Excel</a>
                        <div class="table-responsive mt-4">
                            <table id="tkaryawan" class="table table-sm text-nowrap text-hover" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama</th>
                                        <th rowspan="2">Jabatan</th>
                                        <th colspan="12" style="text-align: center">2024</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($totals as $userId => $userMonths)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th> <!-- Nomor urutan -->
                                            <td></td><!-- Nama pengguna -->
                                            <td></td>
                                            <!-- Jabatan pengguna -->

                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                <td>{{ $userMonths[$month] ?? 0 }}</td>
                                                <!-- Tampilkan total poin per bulan -->
                                            @endforeach

                                            <td>
                                                @php
                                                    $totalPoin = array_sum($userMonths);
                                                @endphp
                                                {{ $totalPoin }} <!-- Total poin untuk pengguna -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- BIDANG -->
                    <div class="tab-pane" id="bidang">
                        <a class="btn btn-outline-success" href="">Download
                            Excel</a>
                        <div class="table-responsive mt-4">
                            <table id="tbidang" class="table table-sm text-nowrap text-hover" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama Bidang</th>
                                        <th colspan="12" style="text-align: center">2024</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <th scope="row">.</th>

                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- BKPH -->
                    <div class="tab-pane" id="bkph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive mt-4">
                            <table id="tbkph" class="table table-sm text-nowrap text-hover" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama BPKH</th>
                                        <th colspan="12" style="text-align: center">2024</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                    </tr>
                                </thead>

                                {{-- <tbody>
                                    @foreach ($totals as $userId => $userMonths)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th> <!-- Nomor urutan -->
                                            <td>{{ $user->nama }}</td> <!-- Nama pengguna -->
                                            <td>{{ $user->jabatan }}</td> <!-- Jabatan pengguna -->
                                
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                <td>{{ $userMonths[$month] ?? 0 }}</td> <!-- Tampilkan total poin per bulan -->
                                            @endforeach
                                
                                            <td>
                                                @php
                                                    $totalPoin = array_sum($userMonths);
                                                @endphp
                                                {{ $totalPoin }} <!-- Total poin untuk pengguna -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}

                            </table>
                        </div>
                    </div>

                    <!-- KRPH -->
                    <div class="tab-pane" id="krph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive mt-4">
                            <table id="tkrph" class="table table-sm text-nowrap text-hover" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama KRPH</th>
                                        <th colspan="12" style="text-align: center">2024</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <th scope="row">.</th>

                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ASPER -->
                    <div class="tab-pane" id="asper">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive mt-4">
                            <table id="tasper" class="table table-sm text-nowrap table-hover table-striped"
                                style="width: 100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama</th>
                                        <th rowspan="2">Asper/KBKPH</th>
                                        <th colspan="12" style="text-align: center">2024</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <th scope="row">.</th>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- KARYAWAN -->
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" href="#rkaryawan" data-toggle="tab">Rekap Karyawan</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#rbidang" data-toggle="tab">Rekap Bidang</a></li>
                <li class="nav-item"><a class="nav-link" href="#rbkph" data-toggle="tab">Rekap BKPH</a></li>
                <li class="nav-item"><a class="nav-link" href="#rkrph" data-toggle="tab">Rekap KRPH</a></li>
                <li class="nav-item"><a class="nav-link" href="#rasper" data-toggle="tab">Rekap Asper/KBKPH</a></li>
            </ul>
            <div class="mt-4">
                <div class="tab-content">

                    <!-- KARYAWAN -->
                    <div class="active tab-pane" id="rkaryawan">
                        <a class="btn btn-outline-success" href="">Download
                            Excel</a>
                    </div>

                    <!-- BIDANG -->
                    <div class="tab-pane" id="rbidang">
                        <a class="btn btn-outline-success" href="">Download
                            Excel</a>
                    </div>

                    <!-- BKPH -->
                    <div class="tab-pane" id="rbkph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                    </div>

                    <!-- KRPH -->
                    <div class="tab-pane" id="rkrph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive mt-4">
                            <table id="tkrph" class="table table-sm text-nowrap text-hover" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama KRPH</th>
                                        <th colspan="12" style="text-align: center">2024</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <th scope="row">.</th>

                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ASPER -->
                    <div class="tab-pane" id="rasper">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
