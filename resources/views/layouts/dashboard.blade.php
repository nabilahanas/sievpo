@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <title>Dashboard</title>

    <!-- Modal -->
    @foreach ($pengumuman as $index => $item)
        @php
            $modalId = "pengumumanModal{$index}";
            $localStorageKey = "hideModal{$index}";
        @endphp
        <div class="modal fade" id="pengumumanModal{{ $index }}" data-backdrop="static" data-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="pengumumanTitle{{ $index }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="pengumumanTitle{{ $index }}" style="font-size: 20px">
                            {{ $item->judul }}</h4>
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal"
                            @if (!$loop->first)
                            data-next-modal="#pengumumanModal{{ $index + 1 }}"
                            @endif
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="modal-date col-md-4 ml-auto">
                            {{ \Carbon\Carbon::parse($item->tgl_publikasi)->locale('id')->isoFormat('D MMMM YYYY') }}</p>
                        @if ($item->gambar)
                            <img src="{{ asset('storage/gambar-pengumuman/' . $item->gambar) }}" alt="Pengumuman">
                        @else
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
                                alt="Pengumuman">
                        @endif

                        <p>{{ $item->deskripsi }}</p>
                    </div>
                    <div class="modal-footer">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dontShowAgain{{ $index }}">
                            <label class="form-check-label" for="dontShowAgain{{ $index }}">Jangan tampilkan
                                lagi</label>
                        </div>
                        <button type="button" class="btn btn-successv2 close-modal" data-dismiss="modal"
                        @if (!$loop->first)
                            data-next-modal="#pengumumanModal{{ $index + 1 }}"
                        @endif>OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- ADMIN -->
    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <section class="content">
            <div class="container-fluid">
                {{-- <button id="showModalAgain">Tampilkan Modal Lagi</button> --}}

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $total }}</h3>
                                <p>Total Laporan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="/confirm" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $approved }}</h3>
                                <p>Laporan Diterima</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-thumbs-up"></i>
                            </div>
                            <a href="/confirm" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $rejected }}</h3>
                                <p>Laporan Ditolak</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-thumbs-down"></i>
                            </div>
                            <a href="/confirm" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $pending }}</h3>
                                <p>Laporan Perlu Diproses</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-retweet"></i>
                            </div>
                            <a href="/confirm" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $berita }}</h3>
                                <p>Berita</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <a href="/berita" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3> {{ $jmlpengumuman }}</h3>
                                <p>Pengumuman</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <a href="/pengumuman" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3>{{ $jmluser }}</h3>
                                <p>Total User</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="/users" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>

                <!-- Grafik Total Poin -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Total Eviden Poin Tahun <?php echo date('Y'); ?>
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="bulanPoin"></div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Grafik Karyawan -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Rekap Poin Karyawan <?php echo date('M Y'); ?>
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="poinKar"></div>
                            </div>
                        </div>
                    </section>
                </div>
        </section>
    @endif

    <!-- PIMPINAN -->
    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $total }}</h3>
                                <p>Total Laporan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $jmluser }}</h3>
                                <p>Total User</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Total Poin -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Total Eviden Poin Tahun {{$currentYear}}
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary mr-2"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="bulanPoin" height="50"></div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Grafik Karyawan -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Rekap Poin Karyawan {{$currentMonth}}
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary mr-2"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="poinKar" height="60"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    @endif

    <!-- KARYAWAN -->
    @if (auth()->user() && auth()->user()->role->nama_role == 'Karyawan')
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $poin }}</h3>

                                <p>Total Laporan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="/data" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $approvedstatus }}</h3>
                                <p>Laporan Diterima</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-thumbs-up"></i>
                            </div>
                            <a href="/data" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $rejectedstatus }}</h3>

                                <p>Laporan Ditolak</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-thumbs-down"></i>
                            </div>
                            <a href="/data" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $pendingstatus }}</h3>

                                <p>Laporan Diproses</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-retweet"></i>
                            </div>
                            <a href="/data" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Grafik Total Poin -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Total Poin Anda Tahun {{$currentYear}}
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary mr-2"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="totalKar"></div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Grafik Perbandingan Poin -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Perbandingan Total Poin Anda {{$currentMonth}}
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary mr-2"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="bandingKar"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('script')
    <!-- MODAL PENGUMUMAN -->
    <script>
        // // Show modal when the page is fully loaded
        // window.addEventListener('load', function() {
        //     $('#pengumumanModal0').modal('show');
        // });

        // Show modal when the page is fully loaded and not hidden by local storage
        window.addEventListener('load', function() {
            @foreach ($pengumuman as $index => $item)
                var localStorageKey = "hideModal{{ $index }}";
                if (!localStorage.getItem(localStorageKey)) {
                    console.log('#pengumumanModal{{ $index }}');
                    $('#pengumumanModal{{ $index }}').modal('show');
                }
            @endforeach
        });

        // Handle close button click
        $(document).on('click', '.close-modal', function() {
            var nextModalId = $(this).data('next-modal');
            $(this).closest('.modal').modal('hide');

            if (nextModalId) {
                $(nextModalId).modal('show');
            }
        });

        // // Handle close button in modal header
        $(document).on('click', '.close', function() {
            var nextModalId = $(this).data('next-modal');
            $(this).closest('.modal').modal('hide');

            if (nextModalId) {
                $(nextModalId).modal('show');
            }
        });

        // Handle checkbox click
        $(document).on('change', '.form-check-input', function() {
            var modalId = $(this).closest('.modal').attr('id');
            var index = modalId.substring(15); // Extract the index from modalId
            var localStorageKey = "hideModal" + index;
            if ($(this).prop('checked')) {
                localStorage.setItem(localStorageKey, true);
            } else {
                localStorage.removeItem(localStorageKey);
            }
        });

        // Handle button click to show modal again
        document.getElementById('showModalAgain').addEventListener('click', function() {
            // Hapus preferensi penyembunyian modal dari local storage
            localStorage
                .clear(); // Anda juga dapat menggunakan localStorage.removeItem(key) untuk menghapus kunci tertentu jika lebih spesifik
            // Muat ulang halaman untuk menampilkan kembali modal
            window.location.reload();
        });
    </script>

    <!-- ADMIN PIMPINAN TOTAL BULAN -->
    <script>
        var monthsToShow = {!! json_encode($monthsToShow) !!};
        var monthlyTotals = {!! json_encode(array_values($monthlyTotals)) !!};

        Highcharts.chart('bulanPoin', {
            chart: {
                type: 'column'
            },
            credits: {
                enabled: false
            },
            title: false,
            xAxis: {
                categories: monthsToShow,
                crosshair: true
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
                data: monthlyTotals
            }]
        });
    </script>

    <!-- ADMIN PIMPINAN TOTAL KARYAWAN -->
    <script>
        var usersToShow = {!! json_encode($usersToShow) !!};
        var totalPerUser = {!! json_encode(array_values($totalPerUser)) !!};

        var currentMonth = "<?php echo $currentMonth; ?>";

        Highcharts.chart('poinKar', {
            chart: {
                type: 'column'
            },
            credits: {
                enabled: false
            },
            title: false,
            xAxis: {
                categories: usersToShow,
                crosshair: true,
                labels: {
                    rotation: -60,
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Poin',
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
                data: totalPerUser
            }]
        });
    </script>

    <!-- KARYAWAN TOTAL-->
    <script>
        var monthsKar = {!! json_encode($monthsKar) !!};
        var karTotals = {!! json_encode(array_values($karTotals)) !!};

        Highcharts.chart('totalKar', {
            chart: {
                type: 'line'
            },
            credits: {
                enabled: false
            },
            title: false,
            xAxis: {
                categories: monthsKar,
                crosshair: true
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
                data: karTotals
            }]
        });
    </script>

    <!-- KARYAWAN PERBANDINGAN -->
    <script>
        var poinUser = {!! json_encode(array_values($poinUser)) !!};
        var poinAllUser = {!! json_encode(array_values($poinAllUser)) !!};
        Highcharts.chart('bandingKar', {
            chart: {
                type: 'bar'
            },
            title: false,
            xAxis: {
                categories: ['Poin'],
                title: {
                    text: null
                },
                gridLineWidth: 1,
                lineWidth: 0
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Poin',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                },
                gridLineWidth: 0
            },
            plotOptions: {
                bar: {
                    borderRadius: '30%',
                    dataLabels: {
                        enabled: true
                    },
                    groupPadding: 0.1
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Poin Anda',
                data: poinUser
            }, {
                name: 'Poin Seluruh Karyawan',
                data: poinAllUser
            }]
        });
    </script>
@endsection