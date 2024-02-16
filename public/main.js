// Data Eviden Poin
$(document).ready(function () {
    $('#evpo').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [1, 2, 3, 4, 5, 6, 7, 8, 10, 11, 12, 13, 14, 15, 16, 17, 19, 20, 21, 22, 23, 24, 25, 26, 28, 29, 30, 31, 32, 33, 34, 35, 37, 38] }],
        displayLength: 25,
    });
});

// Rekap Harian Karyawan
$(document).ready(function () {
    var groupColumn = 2;
    var table = $('#hkaryawan').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 carihkaryawan'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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

    $('.carihkaryawan').append(`
        <form>
            <div class="input-group">
                <input type="date" class="form-control" name="search" placeholder="search"
                    aria-label="search" aria-describedby="button-addon2">
                 <button class="btn btn-outline-dark" type="submit" id="button-addon2">Cari</button>
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

// Rekap Harian Bidang
$(document).ready(function () {
    $('#hbidang').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 carihbidang'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollCollapse: true,
        paging: false,
    });

    $('.carihbidang').append(`
    <form>
        <div class="input-group">
        <input type="date" class="form-control" name="search" placeholder="search"
            aria-label="search" aria-describedby="button-addon2">
         <button class="btn btn-outline-dark" type="submit" id="button-addon2">Cari</button>
        </div>
    </form>
    `);

    // Order by the grouping
    $('#hbidang').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Rekap Harian BKPH
$(document).ready(function () {
    $('#hbkph').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 carihbkph'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollCollapse: true,
        paging: false,
    });

    $('.carihbkph').append(`
<form>
    <div class="input-group">
    <input type="date" class="form-control" name="search" placeholder="search"
        aria-label="search" aria-describedby="button-addon2">
     <button class="btn btn-outline-dark" type="submit" id="button-addon2">Cari</button>
    </div>
</form>
`);

    // Order by the grouping
    $('#hbkph').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Rekap Harian KRPH
$(document).ready(function () {
    $('#hkrph').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 carihkrph'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollCollapse: true,
        paging: false,
    });

    $('.carihkrph').append(`
<form>
    <div class="input-group">
    <input type="date" class="form-control" name="search" placeholder="search"
        aria-label="search" aria-describedby="button-addon2">
     <button class="btn btn-outline-dark" type="submit" id="button-addon2">Cari</button>
    </div>
</form>
`);

    // Order by the grouping
    $('#hkrph').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});

// Rekap Harian Asper/KBKPH
$(document).ready(function () {
    $('#hasper').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 carihasper'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollCollapse: true,
        paging: false,
    });

    $('.carihasper').append(`
<form>
    <div class="input-group">
    <input type="date" class="form-control" name="search" placeholder="search"
        aria-label="search" aria-describedby="button-addon2">
     <button class="btn btn-outline-dark" type="submit" id="button-addon2">Cari</button>
    </div>
</form>
`);

    // Order by the grouping
    $('#hasper').on('click', 'tr.group', function () {
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
    <div class="input-group mt-2 mb-4">
        <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
            aria-describedby="button-addon2">
            <option>Pilih Bulan</option>
            <option value="01">Januari</option>
            <option value="02">Febuari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>

        <button class="btn btn-outline-dark" type="submit" id="button-addon2">Cari</button>
    </div>
    </form>
    `);
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

// Jabatan
$(document).ready(function () {
    var table = $('#jabatan').DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: 3 }],
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
        columnDefs: [{ orderable: false, targets: 4 }],
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
        columnDefs: [{ orderable: false, targets: 4 }],
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
        columnDefs: [{ orderable: false, targets: 4 }],
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