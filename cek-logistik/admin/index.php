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
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Jumlah Peralatan Logistik</h4>
                        <div class="text-right">
                        <?php
                            $result_brg = $db->query(" SELECT COUNT(kode_brg) as count FROM barang ");
                            $jumlah_brg = $result_brg->fetch_object();
                        ?>
                            <h2 class="font-light m-b-0"><i class="ti-dropbox text-info mr-2"></i><?php echo $jumlah_brg->count; ?></h2>
                            <span class="text-muted">Semua barang</span>
                        </div>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Cek Peralatan Logistik</h4>
                        <div class="text-right">
                        <?php
                            $result_cek = $db->query(" SELECT COUNT(*) as count FROM cek ");
                            $jumlah_cek = $result_cek->fetch_object();
                        ?>
                            <h2 class="font-light m-b-0"><i class="ti-check-box text-success mr-2"></i><?php echo $jumlah_cek->count; ?></h2>
                            <span class="text-muted">Total Cek</span>
                        </div>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 6px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <div class="row">
            <!-- Column -->
            <?php
                $result = $db->query(" SELECT jenis_brg, COUNT(*) as count FROM barang GROUP BY jenis_brg ");
                if (!$result) {
                    die ("Could not query the database: <br>".$db->error);
                }
                while ($row = $result->fetch_object()) {
                    echo '<div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Jumlah '.$row->jenis_brg.'</h4>
                                    <div class="text-right">
                                        <h2 class="font-light m-b-0"><i class="ti-dropbox text-secondary mr-2"></i>'.$row->count.'</h2>
                                        <span class="text-muted" style="font-size: 90%;">Data Peralatan Logistik per Jenis</span>
                                    </div>
                                    <div class="progress mt-3">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%; height: 6px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            ?>
        </div>
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
<!-- Require Footer -->
<!-- ============================================================== -->
<?php require_once 'lib/footer.php'; ?>