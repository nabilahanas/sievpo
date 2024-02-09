// User
$(document).ready(function () {
    var table = $('#user').DataTable({
        scrollY: 600,
        scrollX: true,
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
        scrollY: 600,
        scrollX: true,
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
        scrollY: 600,
        scrollX: true,
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
        scrollY: 600,
        scrollX: true,
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
        scrollY: 600,
        scrollX: true,
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
        scrollY: 600,
        scrollX: true,
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
        scrollY: 600,
        scrollX: true,
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
        scrollY: 600,
        scrollX: true,
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