<!-- ============================================================== -->
<!-- Check Submit -->
<!-- ============================================================== -->
<?php
session_start(); // resume session
if (!isset($_SESSION['kode'])) { // cek session
    header('Location: ../login.php');
}else {
    if($_SESSION['role'] == 'PIC'){
        header('Location: ../tabel-cek.php');
    }
}
require_once 'lib/db_login.php';
$kode_brg = $_GET['kode_brg']; // Get kode dari header http atau url

if (!isset($_POST['submit'])) {
    $result = $db->query(" SELECT * FROM barang WHERE kode_brg='".$kode_brg."' ");
    if (!$result) {
        die ("could not query the database: <br>".$db->error);
    }else {
        while ($row = $result->fetch_object()) {
            $pic = $row->pic;
            $jenis = $row->jenis_brg;
            $nama = $row->nama_brg;
            $lokasi = $row->lokasi;
            $tahun = $row->tahun;
        }
    }  
} else {
    $valid = TRUE;

    $kode_brg = test_input($_POST['kode_brg']);
    $pic = test_input($_POST['pic']);
    $jenis = test_input($_POST['jenis']);
    $nama = test_input($_POST['nama']);
    $lokasi = test_input($_POST['lokasi']);
    $tahun = test_input($_POST['tahun']);

    if($valid){
        // escape inputs data
        $kode_brg = $db->real_escape_string($kode_brg);
        $pic = $db->real_escape_string($pic);
        $jenis = $db->real_escape_string($jenis);
        $nama = $db->real_escape_string($nama);
        $lokasi = $db->real_escape_string($lokasi);
        $tahun = $db->real_escape_string($tahun);

        // execute query
        $result = $db->query(" UPDATE barang SET jenis_brg='".$jenis."', nama_brg='".$nama."',
                              tahun='".$tahun."', lokasi='".$lokasi."', pic='".$pic."' WHERE kode_brg='".$kode_brg."' ");

        if (!$result) {
            // die ("could not query the database: <br>".$db->error);
            // close connection
            $db->close();
            header('Location: tabel-barang.php?success=-2');
        }else {
            // close connection
            $db->close();
            header('Location: tabel-barang.php?success=2');
        }
    }
}
?>
<!-- ============================================================== -->
<!-- Require Header -->
<!-- ============================================================== -->
<?php require_once "lib/header.php"; ?>
<!-- ============================================================== -->
<!-- Require Top Bar -->
<!-- ============================================================== -->
<?php require_once "lib/topbar.php"; ?>
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper ml-0">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="card" style="margin-top: 3%; margin-bottom: 6%;">
            <div class="card-body">
                <h4 class="card-title text-center">Edit Peralatan</h4>
                <br>
                <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?kode_brg='.$kode_brg; ?>" enctype="multipart/form-data">
                    <div class="form-row mb-3">
                        <div class="form-group col-md-5">
                            <label for="kode_brg">Kode Peralatan</label>
                            <input type="text" class="form-control" id="kode_brg" name="kode_brg" value="<?php echo $kode_brg; ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pic">PIC</label>
                            <input type="text" class="form-control" id="pic" name="pic" value="<?php echo $pic; ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" value="<?php echo $tahun; ?>" required>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-3">
                            <label for="jenis">Jenis Barang</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $jenis; ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $lokasi; ?>" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-end">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary d-inline-block mr-3" name="submit" value="submit">Submit</button>
                            <a href="tabel-barang.php" class="btn btn-danger d-inline-block">Cancel</a>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
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
<!-- Require Footer -->
<!-- ============================================================== -->
<?php require_once 'lib/footer.php'; ?>