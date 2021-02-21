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
<div class="page-wrapper d-print-none">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="card">
            <div class="card-body">
                <form action="" class="form-horizontal form-material">
                    <div class="form-row pb-2">
                        <div class="form-group col-3">
                            <label for="tanggal-awal">Dari Tanggal</label>
                            <input type="date" name="tanggal-awal" id="tanggal-awal" class="form-control form-control-line">
                        </div>
                        <div class="col-1"></div>
                        <div class="form-group col-3">
                            <label for="tanggal-awal">Sampai Tanggal</label>
                            <input type="date" name="tanggal-awal" id="tanggal-awal" class="form-control form-control-line">
                        </div>
                        <div class="col-1"></div>
                        <div class="col-3">
                            <div class="dropright">
                                <button type="button" class="btn btn-info dropdown-toggle" id="export-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Export</button>
                                <div class="dropdown-menu" arialabelledby="export-btn">
                                    <button type="button" class="dropdown-item" onclick="window.print()">PDF</button>
                                    <button type="button" class="dropdown-item" onclick="">Excel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Tabel Peralatan Logistik</h4>
                <div class="table-responsive-sm">
                    <table class="table user-table">
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
                            </tr>
                        </thead>
                        <tbody>
                        <?php
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
                                echo '</tr>';
                            }
                            $result->free();
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
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
<!-- Page Print -->
<!-- ============================================================== -->
<div class="d-none d-print-block">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Tabel Peralatan Logistik</h4>
                <div class="table-responsive-sm">
                    <table class="table user-table">
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
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $resultPrint = $db->query(" SELECT * FROM cek ORDER BY tgl_cek DESC");
                            if (!$resultPrint) {
                                die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
                            }
                            while ($rowPrint = $resultPrint->fetch_object()) {
                                echo '<tr>';
                                    echo '<td>'.$rowPrint->kode_brg.'</td>';
                                    echo '<td>'.$rowPrint->jenis_brg.'</td>';
                                    echo '<td>'.$rowPrint->nama_brg.'</td>';
                                    echo '<td>'.$rowPrint->tahun.'</td>';
                                    echo '<td>'.$rowPrint->lokasi.'</td>';
                                    echo '<td>'.$rowPrint->pic.'</td>';
                                    echo '<td>'.$rowPrint->tgl_cek.'</td>';
                                    echo '<td>'.$rowPrint->kondisi.'</td>';
                                    echo '<td>'.$rowPrint->keterangan.'</td>';
                                echo '</tr>';
                            }
                            $resultPrint->free();
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Page Print -->
<!-- ============================================================== -->
<?php
    $db->close();
?>
<!-- ============================================================== -->
<!-- Require Footer -->
<!-- ============================================================== -->
<?php require_once 'lib/footer.php'; ?>