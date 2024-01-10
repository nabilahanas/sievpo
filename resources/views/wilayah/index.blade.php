<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wilayah</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp"
        crossorigin="anonymous">
</head>

<body>

    <div class="container mt-4">
        <h1>Data Wilayah</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Wilayah</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wilayahs as $wilayah)
                    <tr>
                        <td>{{ $wilayah->nama_wilayah }}</td>
                        <td>{{ $wilayah->latitude }}</td>
                        <td>{{ $wilayah->longitude }}</td>
                        <td>{{ $wilayah->deskripsi }}</td>
                        <td>
                            <!-- Tambahkan tombol-tombol aksi sesuai kebutuhan -->
                            <button class="btn btn-sm btn-info">Detail</button>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rHyoN1iRsVXV4nD0Jut5XuOVfdIoA01fSkzB7ti7ihFdaLl5+qXaVi0B2A2vcybp"
        crossorigin="anonymous"></script>

</body>
</html>

