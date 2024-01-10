<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Wilayah</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp"
        crossorigin="anonymous">
</head>

<body>

    <div class="container mt-4">
        <h1>Form Tambah Data Wilayah</h1>

        <form action="{{ route('wilayah.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_wilayah" class="form-label">Nama Wilayah:</label>
                <input type="text" class="form-control" name="nama_wilayah" required>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude:</label>
                <input type="text" class="form-control" name="latitude" required>
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude:</label>
                <input type="text" class="form-control" name="longitude" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>

        <a href="{{ route('wilayah.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Wilayah</a>
    </div>

    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp"
        crossorigin="anonymous"></script>
</body>

</html>
