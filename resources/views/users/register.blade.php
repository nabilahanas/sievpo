@extends ('layouts.page')

@section('content')

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
                                <input type="text" name="nama_user" class="form-control" autofocus Required
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control" Required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" name="no_hp" class="form-control" Required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($role as $role)
                                        <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" Required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="jabatan">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($jabatan as $jabatan)
                                        <option value="{{ $jabatan->id_jabatan }}">{{ $jabatan->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="wilayah" class="form-label">Wilayah</label>
                                <input name="wilayah" id="wilayah" class="form-control">
                                @foreach ($jabatan as $jabatan)
                                        <div value="{{ $jabatan->wilayah}}">{{ $jabatan->wilayah }}</div>
                                    @endforeach
                            </div> --}}

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
@endsection
    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp" crossorigin="anonymous">
    </script>

</body>

</html>
