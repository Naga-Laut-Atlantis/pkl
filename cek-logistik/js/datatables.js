//script datatables admin/tabel-cek.php
$(document).ready(function () {
  var table = $("#tabel-print").DataTable({
    lengthChange: false,
    buttons: [
      {
        extend: "print",
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
        },
      },
      {
        extend: "excel",
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
        },
        // customize: function ( xlsx ) {
        //     var sheet = xlsx.xl.worksheets['sheet1.xml'];
        //     $( 'row c', sheet ).attr( 's', '25' );
        //     $( 'row:first c', sheet ).attr( 's', '51' );
        // }
      },
      {
        extend: "pdf",
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
        },
      },
    ],
    order: [[6, "desc"]],
  });

  table.buttons().container().appendTo("#tabel-print_wrapper .col-md-6:eq(0)");
});

//script datatables admin/tabel-barang.php
$(document).ready(function () {
  var table = $("#tabel-barang").DataTable({
    lengthChange: false,
    buttons: [
      {
        extend: "print",
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5],
        },
      },
      {
        extend: "excel",
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5],
        },
        customize: function (xlsx) {
          var sheet = xlsx.xl.worksheets["sheet1.xml"];
          $("row c", sheet).attr("s", "25");
          $("row:first c", sheet).attr("s", "51");
        },
      },
      {
        extend: "pdf",
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5],
        },
      },
    ],
  });

  table.buttons().container().appendTo("#tabel-barang_wrapper .col-md-6:eq(0)");
});

// script datatables tabel-cek.php
$(document).ready(function () {
  var table = $("#tabel-cek").DataTable({
    lengthChange: true,
    order: [[6, "desc"]],
  });
  table.buttons().container().appendTo("#tabel-cek_wrapper .col-md-6:eq(0)");
});
