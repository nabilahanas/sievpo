// Data Eviden Poin
$(document).ready(function () {
    $('#evpo').DataTable({
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [4, 8] }],
        displayLength: 25,
    });
});

// Konfirmasi Data
$(document).ready(function () {
    $('#konfirm').DataTable({
        dom: "<'row'<'col-sm-10 col-md-6 carikonfirm'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [{ orderable: false, targets: [6, 8] }],
    });

    $('.carikonfirm').append(`
    <form>
    <div class="input-group mt-2 mb-4">
        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Status</option>
            <option value="01">Diproses</option>
            <option value="02">Diterima</option>
            <option value="03">Ditolak</option>
        </select>

        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
    </div>
    </form>
    `);
});

// Rekap Harian
$(document).ready(function () {
    var groupColumn = 2;
    var table = $('#harian').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 cariharian'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [{ visible: false, targets: groupColumn },
        { orderable: false, targets: [4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20, 22, 23, 24, 25, 26, 27, 28, 29, 31, 32, 33, 34, 35, 36, 37, 38] }],
        // { visible: false, targets: -1, }],
        order: [[groupColumn, 'asc']],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: 'current' }).nodes();
            var last = null;

            api
                .column(groupColumn, { page: 'current' })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before('<tr class="group"><td colspan="39">' + group + '</td></tr>');

                        last = group;
                    }
                });
        },
    });

    $('.cariharian').append(`
        <form>
            <div class="input-group col-md-8 mt-2 mb-4">
                <input type="date" class="form-control" name="search" placeholder="search"
                    aria-label="search" aria-describedby="button-addon2">
                 <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
            </div>
        </form>
    `);

    // Order by the grouping
    $('#hkaryawan').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Rekap Bulanan
$(document).ready(function () {
    $('#bulanan').DataTable({
        dom: "<'row'<'col-sm-10 col-md-6 caribulanan'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 600,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [{ orderable: false, targets: [3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 23, 24, 25, 26, 27, 28, 30, 31, 32, 33, 34, 35, 36, 37] }],
    });

    $('.caribulanan').append(`
    <form>
    <div class="input-group col-md-8 mt-2 mb-4">
        <input type="month" class="form-control" name="search" placeholder="search"
            aria-label="search" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
    </div>
    </form>
    `);
});

// Rekap Total Karyawan
$(document).ready(function () {
    $('#tkaryawan').DataTable({
        dom: "<'row'<'col-sm-10 col-md-6 caritkaryawan'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $('.caritkaryawan').append(`
        <div class="container">
        <div class="input-group date" id="datarange" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#datarange"/>
            <div class="input-group-append" data-target="#daterange" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
        `);

    // Date Range Picker initialization
    $('input[name="daterange"]').daterangepicker({
        opens: 'left'
    }, function (start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
});

// Rekap Total Bidang
$(document).ready(function () {
    $('#tbidang').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 caritbidang'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $('.caritbidang').append(`
    <form>
    <div class="input-group mt-2 mb-4">
        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Semester</option>
            <option value="01">Semester I (Januari-Juni)</option>
            <option value="02">Semester II (Juli-Desember)</option>
        </select>

        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Tahun</option>
            <option value="01">2024</option>
            <option value="02">2025</option>
            <option value="03">2026</option>
        </select>

        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
    </div>
    </form>
    `);

    // Order by the grouping
    $('#tbidang').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Rekap Total BKPH
$(document).ready(function () {
    $('#tbkph').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 caritbkph'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $('.caritbkph').append(`
    <form>
    <div class="input-group mt-2 mb-4">
        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Semester</option>
            <option value="01">Semester I (Januari-Juni)</option>
            <option value="02">Semester II (Juli-Desember)</option>
        </select>

        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Tahun</option>
            <option value="01">2024</option>
            <option value="02">2025</option>
            <option value="03">2026</option>
        </select>

        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
    </div>
    </form>
    `);

    // Order by the grouping
    $('#tbkph').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Rekap Total KRPH
$(document).ready(function () {
    $('#tkrph').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 caritkrph'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $('.caritkrph').append(`
    <form>
    <div class="input-group mt-2 mb-4">
        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Semester</option>
            <option value="01">Semester I (Januari-Juni)</option>
            <option value="02">Semester II (Juli-Desember)</option>
        </select>

        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Tahun</option>
            <option value="01">2024</option>
            <option value="02">2025</option>
            <option value="03">2026</option>
        </select>

        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
    </div>
    </form>
    `);

    // Order by the grouping
    $('#tkrph').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Rekap Total Asper/KBKPH
$(document).ready(function () {
    $('#tasper').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 caritasper'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $('.caritasper').append(`
    <form>
    <div class="input-group mt-2 mb-4">
        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Semester</option>
            <option value="01">Semester I (Januari-Juni)</option>
            <option value="02">Semester II (Juli-Desember)</option>
        </select>

        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Tahun</option>
            <option value="01">2024</option>
            <option value="02">2025</option>
            <option value="03">2026</option>
        </select>

        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
    </div>
    </form>
    `);

    // Order by the grouping
    $('#tasper').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// User
$(document).ready(function () {
    var table = $('#user').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: 6 }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#user').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Riwayat User
$(document).ready(function () {
    var table = $('#ruser').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: 6 }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#ruser').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Karyawan
$(document).ready(function () {
    var table = $('#karyawan').DataTable({
        columnDefs: [{ orderable: false, targets: 3 }],
        scrollCollapse: true,
        displayLength: 25,
    });

    // Order by the grouping
    $('#karyawan').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Riwayat Karyawan
$(document).ready(function () {
    var table = $('#rkaryawan').DataTable({
        columnDefs: [{ orderable: false, targets: 3 }],
        scrollCollapse: true,
        displayLength: 25,
    });

    // Order by the grouping
    $('#rkaryawan').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Jabatan
$(document).ready(function () {
    var table = $('#jabatan').DataTable({
        columnDefs: [{ orderable: false, targets: 4 }],
        scrollCollapse: true,
        displayLength: 25,
    });

    // Order by the grouping
    $('#jabatan').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Bidang
$(document).ready(function () {
    var table = $('#bidang').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: 3 }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#bidang').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Wilayah
$(document).ready(function () {
    var table = $('#wilayah').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: 4 }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#wilayah').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

//Lokasi
$(document).ready(function () {
    var table = $('#lokasi').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: 4 }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#lokasi').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Shift
$(document).ready(function () {
    var table = $('#shift').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: 5 }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#shift').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Berita
$(document).ready(function () {
    var table = $('#berita').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [2, 3, 4] }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#berita').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Riwayat Berita
$(document).ready(function () {
    var table = $('#rberita').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [2, 3, 4] }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#berita').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Pengumuman
$(document).ready(function () {
    var table = $('#pengumuman').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [2, 3, 4] }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#pengumuman').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Riwayat Pengumuman
$(document).ready(function () {
    var table = $('#rpengumuman').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [2, 3, 4] }],
        displayLength: 25,
    });

    // Order by the grouping
    $('#rpengumuman').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});