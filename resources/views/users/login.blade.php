<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Login" name="description">

    <title>Login</title>

    <!-- Google Font: Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- icheck bootstrap -->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.css"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.css">
</head>

<body class="hold-transition login-page">
    <div class="split left">
        <div class="centered">
            <div class="intro-wrapper">
                <h1 class="intro-title"><b>Selamat Datang Pengguna SIEVPO</b></h1>
                <p class="intro-text">SIEVPO hanya bisa dimasuki oleh pengguna yang sudah didaftarkan oleh Admin SIEVPO.
                    Terima kasih!</p>
                <a href="/" class="btn btn-outline-success">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
    <div class="split right">
        <div class="centered">
            <div class="card-body p-0">
                <div style="text-align: center"><img
                        src="https://upload.wikimedia.org/wikipedia/id/2/2b/Perhutani_logo.svg" style="padding-top: 2%"
                        height="80%" width="80%" alt="Perhutani"></div>
                <div class="row justify-content-center">
                    <div class="card card-outline rounded-lg mt-5 card-primary">
                        <div class="card-body">
                            <form action="/ceklogin" method="POST">
                                @csrf
                                <div class="card-header text-center">
                                    <a href="/login" class="h1"><b>SIEVPO</b></a>
                                </div>
                                <p class="login-box-msg" style="font-size: 14px">Sistem Informasi Eviden
                                    Poin
                                </p>
                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger" role="alert" style="font-size: 13px">
                                        {{ $message }}</div>
                                @endif
                                <div class="input-group mb-3">
                                    <input type="text" name="nip" class="form-control" placeholder="NIP" required
                                        autocomplete="off" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required autocomplete="off">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <input class="btn btn-successv2 btn-block" type="submit" value="Login">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
