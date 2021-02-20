<!-- ============================================================== -->
<!-- Cek Session -->
<!-- ============================================================== -->
<?php
    session_start(); // resume session
    if (!isset($_SESSION['kode'])) { // cek session
        header('Location: ../login.php');
    }else {
        if($_SESSION['role'] == 'PIC'){
            header('Location: ../');
        }
    }
?>
<!-- ============================================================== -->
<!-- Require Header -->
<!-- ============================================================== -->
<?php require_once "lib/header.php"; ?>
<!-- ============================================================== -->
<!-- Require Bar -->
<!-- ============================================================== -->
<?php require_once "lib/topbar.php"; ?>
<?php require_once "lib/sidebar.php"; ?>
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-inline">Tabel Peralatan Logistik</h4>
                        <a href="add-barang.php" type="button" class="btn btn-primary float-right d-inline-block"><i class="fas fa-plus"></i>&nbsp;Cek Peralatan</a>
                        <div class="table-responsive-sm">
                            <table class="table user-table" style="table-layout: auto;">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Kode Peralatan</th>
                                        <th class="border-top-0">Jenis Barang</th>
                                        <th class="border-top-0">Nama Barang</th>
                                        <th class="border-top-0">Tahun</th>
                                        <th class="border-top-0">Lokasi</th>
                                        <th class="border-top-0">PIC</th>
                                        <th class="border-top-0">Tanggal Cek</th>
                                        <th class="border-top-0">Kondisi</th>
                                        <th class="border-top-0">Keterangan</th>
                                        <th class="border-top-0">Action</th>
                                    <tr>
                                </thead>
                                <tbody>
                                <?php
                                    // execute query
                                    $result = $db->query(" SELECT * FROM cek ORDER BY tgl_cek DESC");
                                    if (!$result) {
                                        die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
                                    }
                                    while ($row = $result->fetch_object()) {
                                        echo '<tr>';
                                        echo '<td>'.$row->kode_brg.'</td>';
                                        echo '<td>'.$row->jenis_brg.'</td>';
                                        echo '<td>'.$row->nama_brg.'</td>';
                                        echo '<td>'.$row->tahun.'</td>';
                                        echo '<td>'.$row->lokasi.'</td>';
                                        echo '<td>'.$row->pic.'</td>';
                                        echo '<td>'.$row->tgl_cek.'</td>';
                                        echo '<td>'.$row->kondisi.'</td>';
                                        echo '<td>'.$row->keterangan.'</td>';
                                        echo '<td>
                                                <button type="button" class="btn btn-success text-white mb-1" data-toggle="modal" data-target="#fotoModalAdmin" data-whatever="'.$row->foto.'">Lihat Foto</button>
                                                <a href="edit-barang.php?kode_brg='.$row->kode_brg.'&tgl='.$row->tgl_cek.'" type="button" class="btn btn-warning d-inline-block text-white mb-1">Edit</a>
                                                <button type="button" class="btn btn-danger d-inline-block text-white" data-toggle="modal" data-target="#hapusModal" data-whatever="'.$row->kode_brg.'" data-whatever1="'.$row->tgl_cek.'">Hapus</button>
                                              </td>';
                                        echo '</tr>';
                                    }
                                    $result->free();
                                    $db->close();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Modal hapus -->
    <!-- ============================================================== -->
    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <p class="text-center mb-4" style="font-size: 140%;"><strong>Apakah anda yakin ingin menghapusnya?</strong></p>
                    <a href="" type="button" class="btn btn-danger d-inline-block float-right">Hapus</a>
                    <button type="button" class="btn btn-secondary d-inline-block float-right mr-2" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Modal hapus -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Modal Foto -->
    <!-- ============================================================== -->
    <div class="modal fade" id="fotoModalAdmin" tabindex="-1" role="dialog" aria-labelledby="fotoModalAdminLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fotoModalAdminLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="image" class="d-block mx-auto" style="max-width: 765px; max-height: 530px;">
            </div>
        </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Modal Foto -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center">
        © 2021 PKL UNDIP PT Penerbit Erlangga Semarang
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Require Footer -->
<!-- ============================================================== -->
<?php require_once 'lib/footer.php'; ?>