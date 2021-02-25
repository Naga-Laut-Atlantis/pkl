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
<!-- Set Tanggal  -->
<!-- ============================================================== -->
<?php
setlocale(LC_ALL, 'id-ID', 'id_ID.utf8');
if (isset($_POST['submit'])) {
    $tanggal_awal = $_POST['tanggal-awal'];
    $tanggal_akhir = $_POST['tanggal-akhir'];
}
$tglSekarang = date('Y-m-d');
?>
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
                <form action="" method="POST" class="form-horizontal form-material">
                    <div class="form-row pb-2">
                        <div class="form-group col-3">
                            <label for="tanggal-awal">Dari Tanggal</label>
                            <input type="date" name="tanggal-awal" id="tanggal-awal" class="form-control form-control-line" value="<?php if (isset($tanggal_awal)) {
                                                                                                                                        echo $tanggal_awal;
                                                                                                                                    } else {
                                                                                                                                        echo $tglSekarang;
                                                                                                                                    } ?>">
                        </div>
                        <div class="col-1"></div>
                        <div class="form-group col-3">
                            <label for="tanggal-awal">Sampai Tanggal</label>
                            <input type="date" name="tanggal-akhir" id="tanggal-akhir" class="form-control form-control-line" value="<?php if (isset($tanggal_akhir)) {
                                                                                                                                        echo $tanggal_akhir;
                                                                                                                                    } else {
                                                                                                                                        echo $tglSekarang;
                                                                                                                                    } ?>">
                        </div>
                        <div class="col-1"></div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary mb-3" id="submit" name="submit">Tampil</button>
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
                            if (isset($tanggal_awal)) {
                                $query = " SELECT * FROM cek WHERE tgl_cek BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' ORDER BY tgl_cek DESC ";
                            } else {
                                $query = " SELECT * FROM cek WHERE tgl_cek BETWEEN '".$tglSekarang."' AND '".$tglSekarang."' ORDER BY tgl_cek DESC ";
                            }
                            $result = $db->query($query);
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
                <p class="card-title text-center" style="font-size: 200%">Tabel Peralatan Logistik</p>
                <p class="card-title text-center" style="font-size: 120%">Periode tanggal <?php if (isset($tanggal_awal)) {
                                                                                            echo strftime('%d %B %Y', strtotime($tanggal_awal));
                                                                                        } else {
                                                                                            echo strftime('%d %B %Y', strtotime($tglSekarang));
                                                                                        } ?>
                                                                        Sampai tanggal <?php if (isset($tanggal_akhir)) {
                                                                                            echo strftime('%d %B %Y', strtotime($tanggal_akhir));
                                                                                        } else {
                                                                                            echo strftime('%d %B %Y', strtotime($tglSekarang));
                                                                                        } ?></p>
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
                            if (isset($tanggal_awal)) {
                                $queryPrint = " SELECT * FROM cek WHERE tgl_cek BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' ORDER BY tgl_cek DESC ";
                            } else {
                                $queryPrint = " SELECT * FROM cek WHERE tgl_cek BETWEEN '".$tglSekarang."' AND '".$tglSekarang."' ORDER BY tgl_cek DESC ";
                            }
                            $resultPrint = $db->query($queryPrint);
                            if (!$resultPrint) {
                                die ("Could not query the database: <br>".$db->error."<br>Query: ".$queryPrint);
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
                <p>Dicetak pada hari <?php echo strftime('%A, %d %B %Y', strtotime($tglSekarang)); ?></p>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Page Print -->
<!-- ============================================================== -->
<?php $db->close(); ?>
<!-- ============================================================== -->
<!-- Require Footer -->
<!-- ============================================================== -->
<?php require_once 'lib/footer.php'; ?>