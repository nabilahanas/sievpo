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
        columnDefs: [{ orderable: false, targets: [6, 9] }],
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
            scrollY: 600,
            scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [{ visible: false, targets: groupColumn },
        { orderable: false, targets: [3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 23, 24, 25, 26, 27, 28, 30, 31, 32, 33, 34, 35, 36, 37] }],
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
    var groupColumn = 2;
    var table = $('#bulanan').DataTable({
        dom: "<'row'<'col-sm-10 col-md-6 caribulanan'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 600,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [{ visible: false, targets: groupColumn },
            { orderable: false, targets: [3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 23, 24, 25, 26, 27, 28, 30, 31, 32, 33, 34, 35, 36, 37] }],
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

        $(".caribulanan").append(`
        <form id="bkaryawan">
            <div class="input-group col-md-8 mt-2 mb-4">
                <select class="form-control" name="bulan" aria-label="bulan" aria-describedby="button-addon2">
                <option selected disabled value="">Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
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
                <select name="tahun" class="form-control">
                    <option selected disabled value="">Pilih Tahun</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
            </div>
        </form>
    `);

    const currentYear = new Date().getFullYear();
    const yearsOption = [currentYear, currentYear - 1, currentYear - 2];
    $('select[name="tahun"]').append(
        yearsOption
            .map((year) => `<option value="${year}">${year}</option>`)
            .join("")
    );
    
        $("#bkaryawan").on("click", "tr.group", function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
                table.order([groupColumn, "desc"]).draw();
            } else {
                table.order([groupColumn, "asc"]).draw();
            }
        });
    });

// Rekap Total Karyawan
 $(document).ready(function () {
    var groupColumn = 2;
        var table = $('#tkaryawan').DataTable({
            dom: "<'row'<'col-sm-10 col-md-6 caritkaryawan'l ><'col-sm-10 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
                scrollY: 600,
                scrollX: true,
            scrollCollapse: true,
            paging: false,
            columnDefs: [{ visible: false, targets: groupColumn },
                ],
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

        $('.caritkaryawan').append(`
        <form id="tkar">
            <div class="input-group mt-2 mb-4">
                <select name="search" type="number" class="form-control" placeholder="search" aria-label="search"
                    aria-describedby="button-addon2">
                    <option selected disabled value="">Pilih Semester</option>
                    <option value="01">Semester I (Januari-Juni)</option>
                    <option value="02">Semester II (Juli-Desember)</option>
                </select>

                <select name="year" class="form-control">
                    <option selected disabled value="">Pilih Tahun</option>
                </select>

                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
            </div>
        </form>
        `);

        const currentYear = new Date().getFullYear();
    const yearsOption = [currentYear, currentYear - 1, currentYear - 2];
    $('select[name="year"]').append(
        yearsOption
            .map((year) => `<option value="${year}">${year}</option>`)
            .join("")
    );

    $("#tkar").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
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