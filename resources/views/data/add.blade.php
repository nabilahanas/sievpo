@extends('layouts.main')

@section('content')
    <title>Data Eviden</title>

    @if ($errors->any())
        <div class="alert alert-danger fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-warning" aria-hidden="true"></i></strong>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-successv2">
        <div class="card-header">
            <i class="fas fa-plus mr-2"></i>Tambah Data Eviden
        </div>
        <form class="form-horizontal" method="post" action="{{ route('data.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="id_user" class="col-sm-2 col-form-label required">Nama</label>
                    <div class="col-sm-10">
                        {{-- input untuk tampilan --}}
                        <input type="text" class="form-control" value="{{ auth()->user()->nama_user }}" required
                            readonly>

                        {{-- input untuk menyimpan nilai --}}
                        <input type="hidden" name="id_user" value="{{ auth()->user()->id_user }}">
                    </div>
                </div>

                <div class="form-group row col-12 col-md-10">
                    <label for="id_bidang" class="col-sm-2 col-form-label required">Bidang</label>
                    <div class="col-sm-10">
                        <select name="id_bidang" class="custom-select" required>
                            <option selected disabled value="">Pilih Bidang</option>
                            @foreach ($bidang as $bidang)
                                <option value="{{ $bidang->id_bidang }}">{{ $bidang->nama_bidang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row col-12 col-md-10">
                    <label for="tgl_waktu" class="col-sm-2 col-form-label required">Tanggal Waktu</label>
                    <div class="col-sm-10">
                        {{-- input untuk tampilan --}}
                        <input type="text" class="form-control" name="tgl_waktu"
                            value="{{ now()->format('d-m-Y H:i:s') }}" disabled>

                        {{-- input untuk menyimpan nilai --}}
                        <input type="hidden" name="tgl_waktu" value="{{ now()->format('Y-m-d H:i:s') }}" required>
                    </div>
                </div>

                <div class="form-group row col-12 col-md-10">
                    <label for="id_shift" class="col-sm-2 col-form-label required">Shift</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $shift->nama_shift }}" required readonly>
                        <input type="hidden" name="id_shift" value="{{ $shift->id_shift }}">
                    </div>
                </div>

                <div class="form-group row col-12 col-md-10">
                    <label for="lokasi" class="col-sm-2 col-form-label required">Lokasi</label>
                    <div class="col-sm-10">
                        {{-- input untuk tampilan --}}
                        <input type="text" class="form-control" name="lokasi" id="lokasi" value="" required
                            readonly>
                        <small class="form-text text-danger">Harap tunggu hingga lokasi muncul!</small>

                        {{-- input untuk menyimpan nilai --}}
                        {{-- <input type="hidden" name="lokasi" value="lokasi"> --}}
                    </div>
                </div>

                <div class="form-group row col-12 col-md-10">
                    <label for="foto" class="col-sm-2 col-form-label required">Bukti Foto</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="foto" name="foto"
                            accept="image/jpeg, image/png, image/jpg, image/svg" required>
                        <small class="form-text text-danger">Foto <b>wajib</b> memiliki timestamp!</small>
                        @if (isset($data['foto']))
                            <!-- Check if image exists in data -->
                            <img src="{{ asset('foto-eviden/' . $data['foto']) }}" class="img-fluid" id="previewImage"
                                style="width: 400px;">
                        @else
                            <img class="img-fluid" id="previewImage" style="max-width: 400px;">
                        @endif
                    </div>
                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/data'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>


    <!-- PREVIEW FOTO EVIDEN -->
    <script>
        document.getElementById('foto').addEventListener('change', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('previewImage').setAttribute('src', e.target.result);
            }

            reader.readAsDataURL(file);
        });
    </script>


    <!-- GET LOCATION USING API -->
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
                    document.getElementById('lokasi').value = areaName;
                })
                .catch(error => {
                    console.error('Error fetching location name:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            getLocation();
        });
    </script>

@endsection
