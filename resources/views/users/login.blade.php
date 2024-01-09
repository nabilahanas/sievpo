<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-ZT626KOXYVzMOGcfj1h74bpZ+4FQakxCo7qVd9u0KuG6rPnzZ1HXe97CuMHuP1Sm53I2lgzLnFrpPwzxbiA+rA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light">

    
    <div class="container">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div style="text-align: center"><img
                    src="https://upload.wikimedia.org/wikipedia/id/2/2b/Perhutani_logo.svg" style="padding-top: 2%"
                    height="25%" width="25%"></div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="p-1">
                        <div class="card rounded-lg mt-5 card-primary">
                            <div class="card-body">
                                <form action="/ceklogin" method="POST">
                                    @csrf
                                    <div class="card-header text-center">
                                        <a href="/login" class="h1"><b>Eviden</b>Poin</a>
                                    </div>
                                    <p class="login-box-msg" style="font-size: 14px">Perum Perhutani KPH Semarang</p>

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
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password" required autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <input name="" id="" class="btn btn-success btn-block" type="submit"
                                            value="Login">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp" crossorigin="anonymous"></script>

</body>

</html>
