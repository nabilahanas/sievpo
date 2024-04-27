@extends('layouts.main')

@section('title', 'Profil User')

@section('content')
    <title>Profil User</title>

    <div class="container-fluid">
        <div class="alert alert-success" role="alert">
            Selamat datang, <b>{{ auth()->user()->nama_user }}</b>!
        </div>

        <div class="card">
            <div class="container py-5">
                <div class="row">

                    <!-- TAMPILAN NAVBAR -->
                    <div class="col-12 col-md-4">
                        <div class="card mb-4">
                            <div class="card-body text-center mt-3 mb-3">
                                @if (auth()->user()->profile_pict)
                                    <img src="{{ asset('storage/profile-pict/' . auth()->user()->profile_pict) }}"
                                        alt="Profile Picture" class="rounded-circle img-fluid" style="max-width: 150px;">
                                @else
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
                                        alt="Profile Picture" class="rounded-circle img-fluid" style="max-width: 150px;">
                                @endif
                                <h5 class="mt-3 mb-1">{{ auth()->user()->nama_user }}</h5>
                                <p class="text-muted mb-1">{{ auth()->user()->role->nama_role }}</p>
                                <p class="text-muted mb-3">Perum Perhutani KPH Semarang</p>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-outline-danger" href="/logout" role="button">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAMPILAN DATA USER LOGIN -->
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-successv2 mt-2 ml-2"><b>Profile Account</b></h3>
                                <ul class="nav nav-tabs justify-content-end">
                                    <li class="nav-item"><a class="nav-link{{ $activeTab == 'info' ? ' active' : '' }}"
                                            href="#info" data-toggle="tab">Personal Info</a></li>
                                    <li class="nav-item"><a class="nav-link{{ $activeTab == 'editfoto' ? ' active' : '' }}"
                                            href="#editfoto" data-toggle="tab">Edit Foto</a></li>
                                    <li class="nav-item"><a class="nav-link{{ $activeTab == 'editpass' ? ' active' : '' }}"
                                            href="#editpass" data-toggle="tab">Edit Password</a></a></li>
                                </ul>
                            </div>

                            <div class="card-body mb-4 ml-4">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO -->
                                    <div class="active tab-pane" id="info">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Nama</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ auth()->user()->nama_user }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">NIP</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ auth()->user()->nip }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Peran</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ auth()->user()->role->nama_role }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Jabatan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    {{ auth()->user()->jabatan->nama_jabatan ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
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
                                                <label class="mb-0">Wilayah</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    @if (auth()->user()->jabatan)
                                                        @if (auth()->user()->jabatan->wilayah == 0)
                                                            Wilayah Timur
                                                        @elseif(auth()->user()->jabatan->wilayah == 1)
                                                            Wilayah Barat
                                                        @endif
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EDIT FOTO PROFILE -->
                                    <div class="tab-pane" id="editfoto">
                                        <form class="form-horizontal" method="post"
                                            action="{{ route('profile.update-profile-picture') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-12 col-md-10">
                                                <div class="form-group">
                                                    <label>Pilih File Foto</label>
                                                    <input class="form-control" type="file" id="profile_pict"
                                                        name="profile_pict" accept="image/*">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <button type="submit" class="btn btn-sm btn-info2"><i
                                                            class="fas fa-sync-alt mr-2"></i>Update</button>
                                                    <a href="{{ route('profile.delete-profile-picture') }}"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="fas fa-redo mr-2"></i>Reset</a>
                                                </div>
                                                <input type="hidden" name="delete_profile_picture" value="0">
                                            </div>
                                        </form>
                                    </div>

                                    <!-- EDIT PASSWORD -->
                                    <div class="tab-pane" id="editpass">
                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                        <form class="form-horizontal" method="post"
                                            action="{{ route('profile.update-password') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="current_password">Password Saat Ini</label>
                                                <input type="password" class="form-control" id="current_password"
                                                    name="current_password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">Password Baru</label>
                                                <input type="password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    id="new_password" name="new_password"
                                                    pattern="^(?=.*[a-z])(?=.*[A-Z]).{8,}$"
                                                    title="Password harus terdiri dari setidaknya 8 karakter, setidaknya satu huruf kecil dan satu huruf besar"
                                                    required>
                                                @error('new_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password_confirmation">Ulangi Password Baru</label>
                                                <input type="password"
                                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                    id="new_password_confirmation" name="new_password_confirmation"
                                                    required>
                                                @error('new_password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Tambahkan validasi untuk memastikan ulang password baru sesuai -->
                                            @if ($errors->has('new_password') && $errors->has('new_password_confirmation'))
                                                <div class="form-group">
                                                    <div class="invalid-feedback">Password baru dan konfirmasi password
                                                        harus cocok.</div>
                                                </div>
                                            @endif
                                            <div class="form-group mb-2">
                                                <button type="submit" class="btn btn-info2"><i
                                                        class="fas fa-sync-alt mr-2"></i>Update Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ambil nilai dari parameter tab pada URL
            var urlParams = new URLSearchParams(window.location.search);
            var activeTab = urlParams.get('tab');

            // Aktifkan tab yang sesuai
            if (activeTab) {
                // Hapus kelas 'active' dari semua tab
                $('.nav-tabs .nav-link').removeClass('active');
                // Tambahkan kelas 'active' ke tab yang sesuai
                $('.nav-tabs a[href="#' + activeTab + '"]').addClass('active');
                // Tampilkan konten tab yang sesuai
                $('.tab-content .tab-pane').removeClass('active');
                $('.tab-content #' + activeTab).addClass('active');
            }
        });
    </script>

@endsection
