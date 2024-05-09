@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <title>Dashboard</title>

    <!-- Modal -->
    @foreach ($pengumuman as $index => $item)
        <div class="modal fade" id="pengumumanModal{{ $index }}" data-backdrop="static" data-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="pengumumanTitle{{ $index }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="pengumumanTitle{{ $index }}" style="font-size: 20px">
                            {{ $item->judul }}</h4>
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal"
                            data-next-modal="#pengumumanModal{{ $index + 1 }}">
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
                            data-next-modal="#pengumumanModal{{ $index + 1 }}">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- ADMIN -->
    @if (auth()->user() && auth()->user()->role->nama_role == 'Admin')
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
                            <a href="/confirm?c_search=approved" class="small-box-footer">Info lebih lanjut <i
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
                            <a href="/confirm?c_search=rejected" class="small-box-footer">Info lebih lanjut <i
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
                            <a href="/confirm?c_search=pending" class="small-box-footer">Info lebih lanjut <i
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
                            {{-- <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Total Eviden Poin Tahun <?php echo date('Y'); ?>
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary" onclick="downloadChartbulanPoin()"><i
                                            class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div> --}}
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
                            {{-- <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Rekap Poin Karyawan <?php echo date('M Y'); ?>
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary" onclick="downloadChartpoinKar()"><i
                                            class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div> --}}
                            <div class="card-body">
                                <div id="poinKar" height="60"></div>
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
                            {{-- <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Total Eviden Poin Tahun {{ $currentYear }}
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary mr-2"
                                        onclick="downloadChartbulanPoin()"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div> --}}
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
                            {{-- <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Rekap Poin Karyawan {{ $currentMonth }}
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary mr-2"
                                        onclick="downloadChartpoinKar()"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div> --}}
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
                                <h3>{{ $poinku }}</h3>
                                <p>Total Poin</p>
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
                            {{-- <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Total Poin Anda Tahun {{ $currentYear }}
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary mr-2"
                                        onclick="downloadCharttotalKar()"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div> --}}
                            <div class="card-body">
                                <div id="totalKar" height="60"></div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Grafik Perbandingan Poin -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                        Perbandingan Total Poin Anda {{ $currentMonth }}
                                    </h3>
                                    <button class="btn btn-sm btn-outline-primary mr-2"
                                        onclick="downloadChartbandingKar()"><i class="bi bi-download"></i>
                                        Download</button>
                                </div>
                            </div> --}}
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
        // Show modal when the page is fully loaded and not hidden by local storage
        $(document).ready(() => {
            const modalIds = {{ Js::from($pengumuman->map(fn($q, $i) => '#pengumumanModal' . $i)) }}
            const hiddenModal = JSON.parse(localStorage.getItem('hiddenModal') ?? '[]');

            console.log(hiddenModal);
            const shownModal = modalIds.filter((res) => !hiddenModal.includes(res));

            const first = shownModal.find((e) => typeof e !== 'undefined');
            $(first).modal('show');
        })

        const nextmodalCB = function() {
            const hiddenModal = JSON.parse(localStorage.getItem('hiddenModal') ?? '[]');
            var nextModalId = $(this).data('next-modal');
            $(this).closest('.modal').modal('hide');

            if (nextModalId && !hiddenModal.includes(nextModalId)) {
                $(nextModalId).modal('show');
            }
        }

        // Handle close button click
        $(document).on('click', '.close-modal', nextmodalCB);

        // // Handle close button in modal header
        $(document).on('click', '.close', nextmodalCB);

        // Handle checkbox click
        $(document).on('change', '.form-check-input', function() {
            var modalId = '#' + $(this).closest('.modal').attr('id');

            let modals = JSON.parse(localStorage.getItem('hiddenModal') ?? '[]');

            if ($(this).prop('checked')) {
                const modalUnique = new Set(modals)
                modalUnique.add(modalId);
                console.log('check', modalId, modals, modalUnique, Array.from(modalUnique))
                modals = Array.from(modalUnique)
                console.log(modals);
            } else {
                modals = modals.filter((ids) => ids !== modalId);
            }

            localStorage.setItem('hiddenModal', JSON.stringify(modals))
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

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- ADMIN PIMPINAN TOTAL BULAN -->
    <script>
        var monthsToShow = {!! json_encode($monthsToShow) !!};
        var monthlyTotals = {!! json_encode(array_values($monthlyTotals)) !!};

        Highcharts.chart('bulanPoin', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total Eviden Poin Tahun ' + {{ $currentYear }},
                align: 'center',
                style: {
                    color: '#007bff'
                }
            },
            xAxis: {
                categories: monthsToShow,
                crosshair: true
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
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                }
            },
            series: [{
                name: 'Total Poin',
                data: monthlyTotals
            }]
        });

        // function downloadChartbulanPoin() {
        //     var currentYear = {!! json_encode($currentYear) !!};

        //     var chart = Highcharts.charts[
        //         0]; // hanya memiliki satu chart di halaman, maka menggunakan indeks 0

        //     if (chart) {

        //         chart.exportChart({
        //             type: 'image/png',
        //             filename: 'chart',
        //             options: {
        //                 chart: {
        //                     backgroundColor: '#ffffff'
        //                 },
        //                 title: {
        //                     text: currentYear
        //                 }
        //             }
        //         });
        //     } else {
        //         console.log("Chart tidak ditemukan.");
        //     }
        // }
    </script>

    <!-- ADMIN PIMPINAN TOTAL KARYAWAN -->
    <script>
        var userPoinDatas = {!! $userPoinDatas !!};

        var currentMonth = "<?php echo $currentMonth; ?>";

        Highcharts.chart('poinKar', {
            chart: {
                type: 'column'
            },
            title: {
                text: null
            },
            title: {
                text: 'Rekap Poin Karyawan ' + currentMonth,
                align: 'center',
                style: {
                    color: '#007bff'
                }
            },
            xAxis: {
                categories: userPoinDatas.map(function(data) {
                    return data.name; // Ambil nama pengguna dari data
                }),
                crosshair: true,
                labels: {
                    rotation: -60,
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Poin',
                }
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                }
            },
            series: [{
                name: 'Total Poin',
                data: userPoinDatas.map(function(data) {
                    return data.poin; // Ambil total poin dari data
                })
            }]
        });

        // function downloadChartpoinKar() {

        //     var chart = Highcharts.charts[1];

        //     if (chart) {

        //         chart.exportChart({
        //             type: 'image/png',
        //             filename: 'chart',
        //             options: {
        //                 chart: {
        //                     backgroundColor: '#ffffff'
        //                 },
        //                 title: {
        //                     text: ''
        //                 }
        //             }
        //         });
        //     } else {
        //         console.log("Chart tidak ditemukan.");
        //     }
        // }
    </script>

    <!-- KARYAWAN TOTAL-->
    <script>
        var monthsKar = {!! json_encode($monthsKar) !!};
        var karTotals = {!! json_encode(array_values($karTotals)) !!};

        Highcharts.chart('totalKar', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Total Poin Anda Tahun ' + {{ $currentYear }},
                align: 'center',
                style: {
                    color: '#007bff'
                }
            },
            xAxis: {
                categories: monthsKar,
                crosshair: true
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
                line: {
                    dataLabels: {
                        enabled: true
                    },
                }
            },
            series: [{
                name: 'Total Poin',
                data: karTotals
            }]
        });

        // function downloadCharttotalKar() {

        //     var chart = Highcharts.charts[2];

        //     if (chart) {

        //         chart.exportChart({
        //             type: 'image/png',
        //             filename: 'chart',
        //             options: {
        //                 chart: {
        //                     backgroundColor: '#ffffff'
        //                 },
        //                 title: {
        //                     text: ''
        //                 }
        //             }
        //         });
        //     } else {
        //         console.log("Chart tidak ditemukan.");
        //     }
        // }
    </script>

    <!-- KARYAWAN PERBANDINGAN -->
    <script>
        var poinUser = {!! json_encode(array_values($poinUser)) !!};
        var poinAllUser = {!! json_encode(array_values($poinAllUser)) !!};
        Highcharts.chart('bandingKar', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Perbandingan Total Poin Anda ' + currentMonth,
                align: 'center',
                style: {
                    color: '#007bff'
                }
            },
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

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>

<!-- Dropdown -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
