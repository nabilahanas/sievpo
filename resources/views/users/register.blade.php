<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp" crossorigin="anonymous">
</head>

<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-center">Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="/registered" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_user" class="form-label">Nama</label>
                                <input type="text" name="nama_user" class="form-control" autofocus Required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control" Required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control mb-3" id="role" Required
                                    autocomplete="off">
                                    <option value="">Pilih Role</option>
                                    <option value="Pimpinan">Pimpinan</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Karyawan">Karyawan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" Required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="id_jabatan" class="form-label">Jabatan</label>
                                <input type="text" name="id_jabatan" class="form-control" Required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="id_wilayah" class="form-label">Wilayah</label>
                                <input type="text" name="id_wilayah" class="form-control" Required autocomplete="off">
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <input name="" id="" class="btn btn-primary" type="submit" value="Tambah">
                            <button onclick="window.location='/login'" class="btn btn-danger" type="button"
                                aria-pressed="true">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp" crossorigin="anonymous"></script>

</body>

</html>
