@extends ('layouts.page')

<<<<<<< HEAD
@section('content')

=======
>>>>>>> 0c97b667e43b84de163d13b3ec5ac4859e2120bc
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.css">
</head>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<body class="hold-transition login-page">
    <div class="split left">
        <div class="centered">
            <div class="intro-content-wrapper">
                <h1 class="intro-title"><b>Selamat Datang Pengguna SIEVPO</b></h1>
                <p class="intro-text">SIEVPO hanya bisa dimasuki oleh pengguna yang sudah didaftarkan oleh Admin SIEVPO. Terima kasih!</p>
                <a href="#!" class="btn btn-outline-success">BAIK, SAYA MENGERTI</a>
            </div>
        </div>
    </div>
    <div class="split right">
        <div class="centered">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div style="text-align: center"><img
                        src="https://upload.wikimedia.org/wikipedia/id/2/2b/Perhutani_logo.svg" style="padding-top: 2%"
                        height="80%" width="80%"></div>
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
                                    <input name="" id="" class="btn btn-successv2 btn-block"
                                        type="submit" value="Login">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp" crossorigin="anonymous">
    </script>

</body>

</html>
