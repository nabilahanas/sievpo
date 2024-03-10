@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <title>Dashboard</title>

    <!-- Trigger pop up -->
    @if (session('just_logged_in'))
        {!! session('modal_content') !!}
        <script>
            $(document).ready(function() {
                $('#pengumumanModal').modal('show').static;
                $('#close-modal-button').on('click', function() {
                    setTimeout(function() {
                        $('#pengumumanModal').modal('hide');
                    }, 0);
                });
                $('#close-button').on('click', function() {
                    setTimeout(function() {
                        $('#pengumumanModal').modal('hide');
                    }, 0);
                });
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="pengumumanModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="pengumumanTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            @foreach ($pengumuman as $item)
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pengumumanTitle">{{ $item->judul }}</h5>
                        <button type="button" class="close" id="close-button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (auth()->user()->profile_pict)
                            <img src="{{ asset('storage/gambar-pengumuman/' . $item->gambar) }}" alt="Lights"
                                style="width:100%;">
                        @else
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
                                alt="Lights" style="width:100%;">
                        @endif
                        <p>{{ $item->deskripsi }}</p>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-4 col-sm-10">
                            <div class="form-check text-center">
                                <input type="checkbox" class="form-check-input" id="check">
                                <label class="form-check-label" for="check" style="font-size: 15">Jangan tampilkan
                                    lagi</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close-modal-button">Tutup</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ADMIN -->
    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>
                                <p>Total Poin</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="#" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53</h3>
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
                                <h3>44</h3>
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
                                <h3>65</h3>
                                <p>Laporan Diproses</p>
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
                                <h3>5</h3>
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
                                <h3>65</h3>
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
                                <h3>65</h3>
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
                <!-- Grafik Total -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Total Poin Seluruh Karyawan Per Bulan
                                </h3>
                                <div></div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" width="100" height="50"></canvas>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Grafik Perbandingan -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Perbandingan Rerata Poin Seluruh Karyawan, Bidang, BKPH, KRPH, dan Asper/KBKPH
                                </h3>
                                <div></div>
                            </div>
                            <div class="card-body">
                                <canvas id="barChart" width="50"></canvas>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Maps -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Peta BKPH
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <!-- Google map -->
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126715.79661809531!2d110.33466291719805!3d-7.024722607632933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b4d3f0d024d%3A0x1e0432b9da5cb9f2!2sSemarang%2C%20Semarang%20City%2C%20Central%20Java%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1709016733840!5m2!1sen!2sus"
                                                width="100%" height="100%" style="border:0;" allowfullscreen=""
                                                referrerpolicy="no-referrer-when-downgrade" target=”_blank”></iframe>
                                        </div>
                                        <!-- Google Maps -->
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Bagian</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ auth()->user()->jabatan->bagian ?? '' }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Lokasi</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0" id="subdistrict"></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Latitude</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0" id="latitude"></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Longitude</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0" id="longitude"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
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
                                <h3>150</h3>
                                <p>Total Poin</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="#" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53</h3>
                                <p>Total User</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="/confirm" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Grafik Total -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Total Poin Seluruh Karyawan Per Bulan
                                </h3>
                                <div></div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" width="100" height="50"></canvas>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Grafik Perbandingan -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Perbandingan Rerata Poin Seluruh Karyawan, Bidang, BKPH, KRPH, dan Asper/KBKPH
                                </h3>
                                <div></div>
                            </div>
                            <div class="card-body">
                                <canvas id="barChart" width="50"></canvas>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Maps -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Peta BKPH
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <!-- Google map -->
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126715.79661809531!2d110.33466291719805!3d-7.024722607632933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b4d3f0d024d%3A0x1e0432b9da5cb9f2!2sSemarang%2C%20Semarang%20City%2C%20Central%20Java%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1709016733840!5m2!1sen!2sus"
                                                width="100%" height="100%" style="border:0;" allowfullscreen=""
                                                referrerpolicy="no-referrer-when-downgrade" target=”_blank”></iframe>
                                        </div>
                                        <!-- Google Maps -->
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Bagian</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ auth()->user()->jabatan->bagian ?? '' }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Lokasi</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0" id="subdistrict"></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Latitude</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0" id="latitude"></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Longitude</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0" id="longitude"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                <h3>150</h3>

                                <p>Total Poin</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="#" class="small-box-footer">Info lebih lanjut <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53</h3>
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
                                <h3>44</h3>

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
                                <h3>65</h3>

                                <p>Laporan Diproses</p>
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
                                <h3>5</h3>

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
                                <h3>65</h3>

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
                                <h3>65</h3>

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
                <!-- Grafik Total -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Total Poin Seluruh Karyawan Per Bulan
                                </h3>
                                <div></div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" width="100" height="50"></canvas>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Grafik Perbandingan -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Perbandingan Rerata Poin Seluruh Karyawan, Bidang, BKPH, KRPH, dan Asper/KBKPH
                                </h3>
                                <div></div>
                            </div>
                            <div class="card-body">
                                <canvas id="barChart" width="50"></canvas>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Maps -->
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Peta BKPH
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <!-- Google map -->
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126715.79661809531!2d110.33466291719805!3d-7.024722607632933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b4d3f0d024d%3A0x1e0432b9da5cb9f2!2sSemarang%2C%20Semarang%20City%2C%20Central%20Java%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1709016733840!5m2!1sen!2sus"
                                                width="100%" height="100%" style="border:0;" allowfullscreen=""
                                                referrerpolicy="no-referrer-when-downgrade" target=”_blank”></iframe>
                                        </div>
                                        <!-- Google Maps -->
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Bagian</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ auth()->user()->jabatan->bagian ?? '' }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Lokasi</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0" id="subdistrict"></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Latitude</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0" id="latitude"></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Longitude</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0" id="longitude"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    @endif

@endsection

{{-- GET LOCATION USING API --}}
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // fungsi untuk mendapatkan nama lokasi
                getGeolocationName(latitude, longitude);
            }, function(error) {
                console.error('Error getting location:', error.message);
            });
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    }

    function getGeolocationName(latitude, longitude) {
        // apikey akun geocoding
        var apiKey = '1a6118a363944c9e83e49de502419bcd';

        // URL untuk mengakses OpenCage Geocoding API
        var apiUrl = 'https://api.opencagedata.com/geocode/v1/json?q=' + latitude + '+' + longitude + '&key=' + apiKey;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {

                var components = data.results[0].components;

                // ambil informasi desa, kecamatan, kota, dst
                var village = components.village || "";
                var subdistrict = components.suburb || "";
                var city = components.city || "";
                var county = components.county || "";
                var state = components.state || "";

                // ambil nama daerah berdasarkan prioritas
                var areaName = village || subdistrict || city || county || state;

                // isi otomatis input dengan informasi lengkap
                document.getElementById('subdistrict').innerText = areaName;
                document.getElementById('latitude').innerText = latitude;
                document.getElementById('longitude').innerText = longitude;
            })
            .catch(error => {
                console.error('Error fetching location name:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        getLocation();
    });
</script>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<!-- Dropdown -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
