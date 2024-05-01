// Data Eviden Poin
$(document).ready(function () {
    $("#evpo").DataTable({
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [4, 8] }],
        displayLength: 25,
    });
});

// Rekap Harian
$(document).ready(function () {
    var groupColumn = 2;
    var table = $("#harian").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 cariharian'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [
            { visible: false, targets: groupColumn },
            {
                orderable: false,
                targets: [
                    3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 21,
                    22, 23, 24, 25, 26, 27, 28, 30, 31, 32, 33, 34, 35, 36, 37,
                ],
            },
        ],
        // { visible: false, targets: -1, }],
        order: [[groupColumn, "asc"]],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: "current" }).nodes();
            var last = null;

            api.column(groupColumn, { page: "current" })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr class="group"><td colspan="39">' +
                                group +
                                "</td></tr>"
                            );

                        last = group;
                    }
                });
        },
    });

    $(".cariharian").append(`
        <form>
            <div class="input-group col-md-8 mt-2 mb-4">
                <input type="date" class="form-control" name="search" placeholder="search"
                    aria-label="search" aria-describedby="button-addon2">
                 <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
            </div>
        </form>
    `);

    // Order by the grouping
    $("#hkaryawan").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Mingguan
$(document).ready(function () {
    var groupColumn = 2;
    var table = $("#mingguan").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 carimingguan'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [
            { visible: false, targets: groupColumn },
            {
                orderable: false,
                targets: [
                    3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 21,
                    22, 23, 24, 25, 26, 27, 28, 30, 31, 32, 33, 34, 35, 36, 37,
                ],
            },
        ],
        // { visible: false, targets: -1, }],
        order: [[groupColumn, "asc"]],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: "current" }).nodes();
            var last = null;

            api.column(groupColumn, { page: "current" })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr class="group"><td colspan="39">' +
                                group +
                                "</td></tr>"
                            );

                        last = group;
                    }
                });
        },
    });

    $(".carimingguan").append(`
    <form>
        <div class="input-group col-md-8 mt-2 mb-4">
            <input type="date" class="form-control" name="start_date" placeholder="Tanggal Mulai"
                aria-label="Tanggal Mulai" aria-describedby="button-addon2">
            <input type="date" class="form-control" name="end_date" placeholder="Tanggal Akhir"
                aria-label="Tanggal Akhir" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
        </div>
    </form>
`);

    // Order by the grouping
    $("#mkaryawan").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// REKAP BULANAN ADMIN
// Rekap Bulanan Karyawan
$(document).ready(function () {
    var groupColumn = 2;
    var table = $("#bulanan").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribulanan'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [{ visible: false, targets: groupColumn }],
        order: [[groupColumn, "asc"]],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: "current" }).nodes();
            var last = null;

            api.column(groupColumn, { page: "current" })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr class="group"><td colspan="39">' +
                                group +
                                "</td></tr>"
                            );

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

    $("#bkaryawan").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Bulanan Bidang
$(document).ready(function () {
    $("#bbidang").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribbidang'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caribbidang").append(`
        <form id="bbidang">
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

    $("#bbidang").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Bulanan BKPH
$(document).ready(function () {
    $("#bbkph").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribbkph'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caribbkph").append(`
        <form id="bbkph">
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

    $("#bbkph").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Bulanan KRPH
$(document).ready(function () {
    $("#bkrph").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribkrph'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caribkrph").append(`
        <form id="bkrph">
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

    $("#bkrph").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Bulanan Asper/KBKPH
$(document).ready(function () {
    $("#basper").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribasper'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caribasper").append(`
        <form id="basper">
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

    $("#basper").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// REKAP TOTAL ADMIN
// Rekap Total Karyawan
$(document).ready(function () {
    var groupColumn = 2;
    var table = $("#tkaryawan").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caritkaryawan'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [{ visible: false, targets: groupColumn }],
        order: [[groupColumn, "asc"]],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: "current" }).nodes();
            var last = null;

            api.column(groupColumn, { page: "current" })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr class="group"><td colspan="39">' +
                                group +
                                "</td></tr>"
                            );

                        last = group;
                    }
                });
        },
    });

    $(".caritkaryawan").append(`
        <form id="tkaryawan">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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

    $("#tkaryawan").on("click", "tr.group", function () {
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
    $("#tbidang").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 caritbidang'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        paging: false,
    });

    $(".caritbidang").append(`
    <form id="tbidang">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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

    // Order by the grouping
    $("#tbidang").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Total BKPH
$(document).ready(function () {
    $("#tbkph").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 caritbkph'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        paging: false,
    });

    $(".caritbkph").append(`
    <form id="tbkph">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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

    // Order by the grouping
    $("#tbkph").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Total KRPH
$(document).ready(function () {
    $("#tkrph").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 caritkrph'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        paging: false,
    });

    $(".caritkrph").append(`
    <form id="tkrph">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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
    // Order by the grouping
    $("#tkrph").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Total Asper/KBKPH
$(document).ready(function () {
    $("#tasper").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 caritasper'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        paging: false,
    });

    $(".caritasper").append(`
    <form id="tasper">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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

    // Order by the grouping
    $("#tasper").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// REKAP BULANAN PIMPINAN
// Rekap Bulanan Karyawan
$(document).ready(function () {
    var table = $("#bkaryawanpim").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribkaryawanpim'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caribkaryawanpim").append(`
        <form id="bkaryawanpim">
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

    $("#bkaryawanpim").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Bulanan Bidang
$(document).ready(function () {
    $("#bbidangpim").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribbidangpim'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caribbidangpim").append(`
        <form id="bbidangpim">
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

    $("#bbidangpim").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Bulanan BKPH
$(document).ready(function () {
    $("#bbkphpim").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribbkphpim'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caribbkphpim").append(`
        <form id="bbkphpim">
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

    $("#bbkphpim").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Bulanan KRPH
$(document).ready(function () {
    $("#bkrphpim").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribkrphpim'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caribkrphpim").append(`
        <form id="bkrphpim">
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

    $("#bkrphpim").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Bulanan Asper/KBKPH
$(document).ready(function () {
    $("#basperpim").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caribasperpim'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caribasperpim").append(`
        <form id="basperpim">
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

    $("#basperpim").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// REKAP TOTAL PIMPINAN
// Rekap Total Karyawan
$(document).ready(function () {
    var table = $("#tkaryawanpim").DataTable({
        dom:
            "<'row'<'col-sm-10 col-md-6 caritkaryawanpim'l ><'col-sm-10 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10 col-md-5'i><'col-sm-10 col-md-7'p>>",
        scrollY: 700,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
    });

    $(".caritkaryawanpim").append(`
        <form id="tkaryawanpim">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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

    $("#tkaryawanpim").on("click", "tr.group", function () {
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
    $("#tbidangpim").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 caritbidangpim'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        paging: false,
    });

    $(".caritbidangpim").append(`
    <form id="tbidangpim">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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

    // Order by the grouping
    $("#tbidangpim").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Total BKPH
$(document).ready(function () {
    $("#tbkphpim").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 caritbkphpim'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        paging: false,
    });

    $(".caritbkphpim").append(`
    <form id="tbkphpim">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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

    // Order by the grouping
    $("#tbkphpim").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Total KRPH
$(document).ready(function () {
    $("#tkrphpim").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 caritkrphpim'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        paging: false,
    });

    $(".caritkrphpim").append(`
    <form id="tkrphpim">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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
    // Order by the grouping
    $("#tkrphpim").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Rekap Total Asper/KBKPH
$(document).ready(function () {
    $("#tasperpim").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6 caritasperpim'l ><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        paging: false,
    });

    $(".caritasperpim").append(`
    <form id="tasperpim">
            <div class="input-group mt-2 mb-4">
                <select name="semester" type="number" class="form-control" placeholder="search" aria-label="search"
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

    // Order by the grouping
    $("#tasperpim").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// User
$(document).ready(function () {
    var table = $("#user").DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: 6 }],
        displayLength: 25,
    });

    // Order by the grouping
    $("#user").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Riwayat User
$(document).ready(function () {
    var table = $("#ruser").DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: 6 }],
        displayLength: 25,
    });

    // Order by the grouping
    $("#ruser").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Karyawan
$(document).ready(function () {
    var table = $("#karyawan").DataTable({
        columnDefs: [{ orderable: false, targets: 3 }],
        scrollCollapse: true,
        displayLength: 25,
    });

    // Order by the grouping
    $("#karyawan").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Riwayat Karyawan
$(document).ready(function () {
    var table = $("#rkaryawan").DataTable({
        columnDefs: [{ orderable: false, targets: 3 }],
        scrollCollapse: true,
        displayLength: 25,
    });

    // Order by the grouping
    $("#rkaryawan").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Jabatan
$(document).ready(function () {
    var table = $("#jabatan").DataTable({
        columnDefs: [{ orderable: false, targets: 5 }],
        scrollCollapse: true,
        displayLength: 25,
    });

    // Order by the grouping
    $("#jabatan").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Bidang
$(document).ready(function () {
    var table = $("#bidang").DataTable({
        scrollCollapse: true,
        displayLength: 25,
        columnDefs: [{ orderable: false, targets: 3 }],
        paging: false,
    });

    // Order by the grouping
    $("#bidang").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Shift
$(document).ready(function () {
    var table = $("#shift").DataTable({
        scrollCollapse: true,
        displayLength: 25,
        columnDefs: [{ orderable: false, targets: 5 }],
        paging: false,
    });

    // Order by the grouping
    $("#shift").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Berita
$(document).ready(function () {
    var table = $("#berita").DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [2, 3, 4] }],
        displayLength: 25,
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

// Riwayat Berita
$(document).ready(function () {
    var table = $("#rberita").DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [2, 3, 4] }],
        displayLength: 25,
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

// Pengumuman
$(document).ready(function () {
    var table = $("#pengumuman").DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [2, 3, 4] }],
        displayLength: 25,
    });

    // Order by the grouping
    $("#pengumuman").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

// Riwayat Pengumuman
$(document).ready(function () {
    var table = $("#rpengumuman").DataTable({
        scrollCollapse: true,
        columnDefs: [{ orderable: false, targets: [2, 3, 4] }],
        displayLength: 25,
    });

    // Order by the grouping
    $("#rpengumuman").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});

$(document).ready(() => {
    const currentYear = new Date().getFullYear();
    const yearsOption = [currentYear, currentYear - 1, currentYear - 2];
    $('select[name="year"]').append(
        yearsOption
            .map((year) => `<option value="${year}">${year}</option>`)
            .join("")
    );

    $('select[name="tahun"]').append(
        yearsOption
            .map((year) => `<option value="${year}">${year}</option>`)
            .join("")
    );
})