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
                        <div class="table-responsive-lg mt-4">
                            <table id="tkaryawan" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama</th>
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                            <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $UItem)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}.</td>
                                            <td>{{ $UItem->nama_user }}</td>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    // Periksa apakah karyawan memiliki poin untuk bulan ini
                                                    $poin = isset($karyawanTotals[$UItem->nama_user][$month]) ? $karyawanTotals[$UItem->nama_user][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                
                                            <td>
                                                @php
                                                    // Jumlahkan semua poin untuk pengguna ini
                                                    $userTotal = isset($karyawanTotals[$UItem->nama_user]) ? array_sum($karyawanTotals[$UItem->nama_user]) : 0;
                                                @endphp
                                                {{ $userTotal }}
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
                        <div class="table-responsive-lg mt-4">
                            <table id="tbidang" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama Bidang</th>
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                        <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($bidang as $BItem)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $BItem->nama_bidang }}</td>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    // Periksa apakah karyawan memiliki poin untuk bulan ini
                                                    $poin = isset($bidangTotals[$BItem->nama_bidang][$month]) ? $bidangTotals[$BItem->nama_bidang][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                
                                            <td>
                                                @php
                                                    // Jumlahkan semua poin untuk pengguna ini
                                                    $bidangTotal = isset($bidangTotals[$BItem->nama_bidang]) ? array_sum($bidangTotals[$BItem->nama_bidang]) : 0;
                                                @endphp
                                                {{ $bidangTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                    <!-- BKPH -->
                    <div class="tab-pane" id="bkph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive-lg mt-4">
                            <table id="tbkph" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama BKPH</th>
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                        <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($user as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->jabatan->bagian }}</td>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    // Periksa apakah karyawan memiliki poin untuk bulan ini
                                                    $poin = isset($bkphTotals[$item->bagian][$month]) ? $bkphTotals[$item->bagian][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                            <td>
                                                @php
                                                    // Jumlahkan semua poin untuk bagian ini
                                                    $bkphTotal = isset($bkphTotals[$item->bagian]) ? array_sum($bkphTotals[$item->bagian]) : 0;
                                                @endphp
                                                {{ $bkphTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                                
                                

                            </table>
                        </div>
                    </div>

                    <!-- KRPH -->
                    <div class="tab-pane" id="krph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive-lg mt-4">
                            <table id="tkrph" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama KRPH</th>
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                        <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($jabatan as $krph)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $krph->klasifikasi }}</td>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    // Periksa apakah karyawan memiliki poin untuk bulan ini
                                                    $poin = isset($krphTotals[$krph->bagian][$month]) ? $krphTotals[$krph->bagian][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                
                                            <td>
                                                @php
                                                    // Jumlahkan semua poin untuk pengguna ini
                                                    $krphTotal = isset($krphTotals[$krph->bagian]) ? array_sum($krphTotals[$krph->bagian]) : 0;
                                                @endphp
                                                {{ $krphTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ASPER -->
                    <div class="tab-pane" id="asper">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive-lg mt-4">
                            <table id="tasper" class="table table-sm text-nowrap table-hover table-striped"
                                style="width: 100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama Karyawan</th>
                                        <th rowspan="2">Asper/KBKPH</th>
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                        <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($user as $asper)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $asper->nama_user}}</td>
                                            <td>{{ $asper->jabatan->klasifikasi }}</td>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    // Periksa apakah karyawan memiliki poin untuk bulan ini
                                                    $poin = isset($asperTotals[$asper->bagian][$month]) ? $asperTotals[$asper->bagian][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                
                                            <td>
                                                @php
                                                    // Jumlahkan semua poin untuk bagian ini
                                                    $asperTotal = isset($asperTotals[$asper->bagian]) ? array_sum($asperTotals[$asper->bagian]) : 0;
                                                @endphp
                                                {{ $asperTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
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
