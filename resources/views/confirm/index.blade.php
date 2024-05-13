@extends('layouts.main')

@section('title', 'Konfirmasi Data')

@section('content')
    <title>Konfirmasi Data Eviden</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-check-circle mr-2" aria-hidden="true"></i></strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive-lg mt-4">
                <table id="konfirm" class="table table-sm table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Bidang</th>
                            <th>Shift</th>
                            <th>Lokasi</th>
                            <th>Tanggal Waktu</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Poin</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        // Konfirmasi Data
        $(document).ready(function() {
            const confirm = $("#konfirm").DataTable({
                serverSide: true,
                processing: true,
                ajax: "{{ url()->full() }}",
                dom: "<'row'<'col-sm-10 col-md-6 carikonfirm'l ><'col-sm-10 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
                scrollX: true,
                scrollCollapse: true,
                // paging: false,
                pagingType: 'simple_numbers',
                order: [
                    [0, 'desc']
                ],
                // columnDefs: [{ orderable: false, targets: [6, 9] }],
                columns: [{
                        data: 'id_data',
                        name: 'id_data',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'user.nama_user',
                        name: 'user.nama_user',
                        searchable: true,
                        orderable: false,
                        render: (data, type, row, meta) => {
                            return row.user.nama_user ?? '-';
                        }
                    },
                    {
                        data: 'bidang.nama_bidang',
                        name: 'bidang.nama_bidang',
                        searchable: true,
                        orderable: false,
                        render: (data, type, row, meta) => {
                            return row.bidang.nama_bidang ?? '-';
                        }
                    },
                    {
                        data: 'shift.nama_shift',
                        name: 'shift.nama_shift',
                        searchable: true,
                        orderable: false,
                        render: (data, type, row, meta) => {
                            return row.shift.nama_shift ?? '-';
                        }
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi',
                        searchable: true,
                        orderable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: false,
                        orderable: false,
                        render: (data, type, row, meta) => {
                            return moment(data).format("YYYY-MM-DD hh:mm:ss");
                        }
                    },
                    {
                        data: 'foto',
                        name: 'foto',
                        searchable: false,
                        orderable: false,
                        render: (data, type, row, meta) => {
                            return `
                            <a href="" data-bs-toggle="modal" data-bs-target="#fotoModal${row.id_data}">
                                        Lihat Foto
                                    </a>

                            <!-- Modal -->
                            <div class="modal fade" id="fotoModal${row.id_data}" tabindex="-1" aria-labelledby="fotoModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img src="${data ? '{{ asset('') }}storage/foto-eviden/' + data : ''}"
                                                alt="Foto Eviden" width="700">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-successv2"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>`
                        }
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        searchable: false,
                        orderable: false,
                        render: (data, type, row, meta) => {
                            if (data == 'pending') {
                                return '<div><i class="far fa-clock mr-2" style="color: #FFD43B;"></i>Diproses</div>';
                            } else if (data == 'approved') {
                                return '<div><i class="far fa-check-circle mr-2" style="color: #28a745"></i>Diterima</div>'
                            } else if (data == 'rejected') {
                                return '<div><i class="far fa-times-circle mr-2" style="color: #dc3545"></i>Ditolak</div>'
                            }

                            return ''
                        }
                    },
                    {
                        data: 'poin',
                        name: 'poin',
                        searchable: false,
                        orderable: false,
                        render: (data, type, row, meta) => {
                            return row.poin ?? '-';
                        }
                    },
                    {
                        data: '',
                        name: '',
                        searchable: false,
                        orderable: false,
                        render: (data, type, row, meta) => {
                            return `
                            <form>
                @csrf
                <button type="button" class="btn btn-sm btn-success btn-block mb-2 btn-terima" 
                    data-id="${row.id_data}" ${row.is_approved != 'pending' ? 'disabled' : ''}>
                    <i class="fas fa-check-circle mr-2"></i>Terima
                </button>
                <button type="button" class="btn btn-sm btn-secondary btn-block mb-2 btn-tolak" 
                    data-id="${row.id_data}" ${row.is_approved != 'pending' ? 'disabled' : ''}>
                    <i class="fas fa-times-circle mr-2"></i>Tolak
                </button>
            </form>


                            <button type="button" class="btn btn-sm btn-danger btn-block mb-2"
                                data-bs-toggle="modal" data-bs-target="#hapusModal${row.id_data}">
                                <i class="fas fa-trash mr-2"></i>Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="hapusModal${row.id_data}" tabindex="-1" aria-labelledby="hapusModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ url('/') }}/confirm/delete/${row.id_data}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                Data yang dihapus <b>tidak dapat</b> dipulihkan.
                                                <br>Apakah Anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-danger">Yakin</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            `
                        }
                    }
                ],
            });

            $(document).on('click', '.btn-terima', function() {
                var idData = $(this).data('id');
                var button = $(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ url('/') }}/proses-approval/" + idData + "/approved",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Perbarui status dan poin di tabel
                        var newData = response.data;

                        // Verifikasi kesesuaian data (opsional)
                        console.log(newData);

                        // Dapatkan baris yang sesuai dengan ID data yang diperbarui
                        var row = confirm.DataTable().row($(this).closest('tr'));

                        // Perbarui data dalam baris
                        row.data().is_approved = newData.is_approved;
                        row.data().poin = newData.poin;

                        // Perbarui tampilan tabel
                        confirm.draw();

                        // Tampilkan pesan sukses atau lakukan tindakan lainnya
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan jika ada
                        console.error(error);
                    }
                });
            });


            $(document).on('click', '.btn-tolak', function() {
                var idData = $(this).data('id');
                var button = $(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ url('/') }}/proses-approval/" + idData + "/rejected",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Perbarui status dan poin di tabel
                        var newData = response.data;

                        // Dapatkan baris yang sesuai dengan ID data yang diperbarui
                        var row = confirm.DataTable().row($(this).closest('tr'));

                        // Perbarui data dalam baris
                        row.data().is_approved = newData.is_approved;
                        row.data().poin = newData.poin;

                        // Perbarui tampilan tabel
                        confirm.draw();

                        // Tampilkan pesan sukses atau lakukan tindakan lainnya
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan jika ada
                        console.error(error);
                    }
                });
            });

            confirm.on('draw.dt', function() {
                var info = confirm.page.info();
                confirm.column(0, {
                    search: 'applied',
                    order: 'applied',
                    page: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + info.start;
                });
            });





            $(".carikonfirm").append(`
    <form>
    <div class="input-group mb-3">
        <select name="c_search" type="number" class="form-control" placeholder="c_search" aria-label="search"
            aria-describedby="button-addon2">
            <option value="">Pilih Status</option>
            <option value="pending" @selected(request('c_search') == 'pending')>Diproses</option>
            <option value="approved" @selected(request('c_search') == 'approved')>Diterima</option>
            <option value="rejected" @selected(request('c_search') == 'rejected')>Ditolak</option>
        </select>

        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
    </div>
    </form>
    `);
        });
    </script>
@endsection
