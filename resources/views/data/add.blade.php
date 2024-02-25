@extends('layouts.main')

@section('content')
    <title>Data Eviden</title>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-successv2">
        <div class="card-header">
            <i class="fas fa-plus mr-2"></i>Tambah Data Eviden
        </div>
        <form class="form-horizontal" method="post" action="">
            @csrf
            <div class="row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <div class="form-group row col-12">
                            <label for="" class="col-sm-3 col-form-label required">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_user"
                                    value="{{ auth()->user()->nama_user }}" required disabled>

                                {{-- untuk menyimpan nilai yang akan dikirim ke database --}}
                                <input type="hidden" name="nama_hidden" value="{{ auth()->user()->nama_user }}">
                            </div>
                        </div>

                        <div class="form-group row col-12">
                            <label for="" class="col-sm-3 col-form-label required">Bidang</label>
                            <div class="col-sm-9">
                                <select name="id_bidang" id="" class="form-control">
                                    <option value="" disabled selected>Pilih Bidang</option>
                                    @foreach ($bidang as $bidang)
                                        <option value="{{ $bidang->id_bidang }}">{{ $bidang->nama_bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row col-12">
                            <label for="tgl_waktu" class="col-sm-3 col-form-label required">Tanggal Waktu</label>
                            <div class="col-sm-9">
                                {{-- Input untuk tampilan --}}
                                <input type="text" class="form-control" value="{{ now()->format('d-m-Y H:i:s') }}"
                                    disabled>

                                {{-- Input untuk menyimpan nilai yg disimpan --}}
                                <input type="hidden" name="tgl_waktu" value="{{ now()->format('Y-m-d\TH:i:s') }}" required>
                            </div>
                        </div>


                        <div class="form-group row col-12">
                            <label for="shift" class="col-sm-3 col-form-label required">Shift</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="shift" id=""
                                    value="{{ $shift->nama_shift ?? '' }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row col-12">
                            <label for="lokasi" class="col-sm-3 col-form-label required">Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lokasi" id="" value=""
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="card-body">
                        <div class="form-group col-12">
                            <label for="foto" class="col-form-label required">Bukti Foto</label>
                            <div id="img-area" class="card" style="border-color: #6c757d; width: 16rem">
                                <div class="card-body mt-4 mb-4" style="text-align: center">
                                    <div class="img-area">
                                        <i class="fas fa-camera fa-3x"></i>
                                        <p class="mt-2" style="font-size: 10pt; color: #6c757d">Gunakan kamera
                                            komputer/smartphone Anda untuk
                                            mengambil gambar</p>
                                    </div>
                                    <button id="ambil-foto-btn" class="btn btn-outline-secondary">Ambil Foto</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @push('myscript')
                    <script>
                        Webcam.set({
                            height: 240,
                            width: 320,
                            image_format: 'jpeg',
                            jpeg_quality: 100,

                        });

                        // Define a function to attach Webcam
                        function attachWebcam() {
                            Webcam.attach('#img-area');
                        }

                        // Attach Webcam when the "Ambil Foto" button is clicked
                        document.getElementById('ambil-foto-btn').addEventListener('click', function() {
                            attachWebcam();
                        });
                    </script>
                @endpush

                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/data'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
