//script datatables cek
$(document).ready(function() {
  var table = $('#tabel-print').DataTable( {
      lengthChange: false,
      buttons: [ 
          {
              extend: 'print',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
              }
          },
          {
              extend: 'excel',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
              }
          },
          {
              extend: 'pdf',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
              }
          },
      ],
      "order": [[ 6, "desc" ]]
  } );

  table.buttons().container()
      .appendTo( '#tabel-print_wrapper .col-md-6:eq(0)' );
} );

//script datatables barang
$(document).ready(function() {
    var table = $('#tabel-barang').DataTable( {
        lengthChange: false,
        buttons: [ 
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
        ]
    } );
  
    table.buttons().container()
        .appendTo( '#tabel-barang_wrapper .col-md-6:eq(0)' );
  } );