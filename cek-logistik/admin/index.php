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
        <div class="row justify-content-center">
            <!-- Column -->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Jumlah Peralatan Logistik</h4>
                        <div class="text-right">
                        <?php
                            $result_brg = $db->query(" SELECT COUNT(*) as count FROM cek");
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
        </div>
        <div class="row">
            <!-- Column -->
            <?php
                $result = $db->query(" SELECT jenis_brg FROM barang GROUP BY jenis_brg ");
                if (!$result) {
                    die ("Could not query the database: <br>".$db->error);
                }
                while ($row = $result->fetch_object()) {
                    $result_count = $db->query(" SELECT COUNT(DISTINCT nama_brg) as count FROM cek WHERE jenis_brg='".$row->jenis_brg."' GROUP BY kondisi ORDER BY kondisi ");
                    $i = 0;
                    while($row_count = $result_count->fetch_object()) { 
                        $count[$i] = $row_count->count;
                        $i++;
                    }
                    echo '<div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Jumlah '.$row->jenis_brg.'</h4>
                                    <div class="d-inline-block mx-5">
                                        <h2 class="font-light m-b-0"><i class="ti-dropbox text-success mr-2"></i>'.$count[0].'</h2>
                                        <span class="text-muted" style="font-size: 90%;">Bagus</span>
                                    </div>
                                    <div class="d-inline-block mx-5">
                                        <h2 class="font-light m-b-0"><i class="ti-dropbox text-danger mr-2"></i>'.$count[1].'</h2>
                                        <span class="text-muted" style="font-size: 90%;">Rusak</span>
                                    </div>
                                    <div class="progress mt-3">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%; height: 6px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    $i = 0;
                    $count[0] = 0;
                    $count[1] = 0;
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