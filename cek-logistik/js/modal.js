// script untuk modal hapus
$('#hapusModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data('whatever'); // Extract info from data-* attributes
    var recipient1 = button.data('whatever1'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    var url = "delete-cek.php?kode_brg="+recipient+"&tgl="+recipient1;
    modal.find('a').attr("href", url);
});

// script untuk modal foto
$('#fotoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    var dir = "../assets/images/upload/"
    modal.find('img').attr("src", dir+recipient)
})

// script ajax
function getBarang(kode) {
    $.ajax({
        url: 'lib/response_cek.php',
        data: 'kode='+kode,
        success: function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#pic').val(obj.pic);
            $('#jenis').val(obj.jenis);
            $('#nama').val(obj.nama);
            $('#lokasi').val(obj.lokasi);
            $('#tahun').val(obj.tahun);
            $('#error-kode').text(obj.error);
    }});
}