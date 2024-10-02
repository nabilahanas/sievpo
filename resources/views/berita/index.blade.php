@extends('layouts.main')

@section('title', 'Data Berita')

@section('content')
    <title>Data Berita</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-check-circle mr-2" aria-hidden="true"></i></strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('berita.add') }}" type="button" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</a>

            <div class="table-responsive mt-4">
                <table id="berita" class="table table-sm table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>Tanggal Publikasi</th>
                            <th>Judul Berita</th>
                            <th>Gambar</th>
                            <th>Link Berita</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $("#berita").DataTable({
            scrollCollapse: true,
            columnDefs: [{ orderable: false, targets: [2, 3, 4] }],
            displayLength: 25,
            // Konfigurasi AJAX
            ajax: {
                url: '/berita',
                type: 'GET',
                dataSrc: '' // Karena respons JSON adalah array, dataSrc kosong
            },
            columns: [
                { data: 'tgl_publikasi' },
                { data: 'judul' },
                { data: 'gambar',
                    render: function(data) {
                        return '<img src="/storage/gambar-berita/' + data + '" alt="Gambar Berita" width="150">' }
                    },
                { data: 'deskripsi',
                    render: function(data,type, row){
                        return '<a href="' + data + '" target="_blank">Lihat Berita</a>'
                } },
                {
                data: null,
                render: function(data, type, row) {
                    return `
                        <a href="/berita/edit/${row.id_berita}" type="button" class="btn btn-sm btn-warning btn-block mb-2">
                            <i class="fas fa-pen mr-2"></i>Ubah
                        </a>
                        <button type="button" class="btn btn-sm btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#hapusModal${row.id_berita}">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                        <div class="modal fade" id="hapusModal${row.id_berita}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="/berita/delete/${row.id_berita}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            Data karyawan yang dihapus <b>dapat</b> dipulihkan.
                                            <br>Apakah Anda yakin ingin menghapus data ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-danger">Yakin</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }
            ],
        });

        // Order by the grouping
        $("#berita").on("click", "tr.group", function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
                table.order([groupColumn, "desc"]).draw();
            } else {
                table.order([groupColumn, "asc"]).draw();
            }
        });
    });

</script>
@endsection