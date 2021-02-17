<!-- ============================================================== -->
<!-- Check Submit -->
<!-- ============================================================== -->
<?php
session_start(); // resume session
if (!isset($_SESSION['kode'])) { // cek session
    header('Location: login.php');
}else {
    if($_SESSION['role'] != 'PIC'){
        header('Location: admin/');
    }
}
require_once 'lib/db_login.php';
$kode_brg = $_GET['kode_brg']; // Get kode dari header http atau url
$tanggal = $_GET['tgl']; // Get kode dari header http atau url

if (!isset($_POST['submit'])) {
    $result = $db->query(" SELECT * FROM cek WHERE kode_brg='".$kode_brg."' AND tgl_cek='".$tanggal."' ");
    if (!$result) {
        die ("could not query the database: <br>".$db->error);
    }else {
        while ($row = $result->fetch_object()) {
            $pic = $row->pic;
            $tanggal = $row->tgl_cek;
            $jenis = $row->jenis_brg;
            $nama = $row->nama_brg;
            $lokasi = $row->lokasi;
            $tahun = $row->tahun;
            $kondisi = $row->kondisi;
            $keterangan = $row->keterangan;
        }
    }  
} else {
    $valid = TRUE;
    $foto_valid = FALSE;

    $kode_brg = test_input($_POST['kode_brg']);
    $pic = test_input($_POST['pic']);
    $tanggal = test_input($_POST['tanggal']);
    $jenis = test_input($_POST['jenis']);
    $nama = test_input($_POST['nama']);
    $lokasi = test_input($_POST['lokasi']);
    $tahun = test_input($_POST['tahun']);
    $kondisi = test_input($_POST['kondisi']);
    $keterangan = test_input($_POST['keterangan']);

    // Cek apakah gambar diganti / telah diupload
    if(is_uploaded_file($_FILES['foto']['tmp_name'])){
        $target_dir = "../assets/images/upload/";
        $target_file = $target_dir.basename($_FILES['foto']['name']);
        $foto_valid = TRUE;
        
        // Cek apakah yang di upload gambar atau bukan
        $check_img = getimagesize($_FILES['foto']['tmp_name']);
        if($check_img == FALSE) {
            $error_foto = "Maaf, File bukan gambar";
            $foto_valid = FALSE;
        }

        //Cek apakah file sudah ada atau tidak
        if ($target_file == $_FILES['foto']['name']) {
            $error_foto = "Maaf, Gambar sudah ada";
            $foto_valid = FALSE;
        }

        if ($foto_valid) {
            $foto = $db->real_escape_string($_FILES['foto']['name']);

            // Hapus gambar lama
            $result = $db->query(" SELECT foto FROM cek WHERE kode_brg='".$kode_brg."' ");
            $row = $result->fetch_object();
            unlink($target_dir.$row->foto);

            // Pindahkan gambar ke direktori target
            move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
        }
    }

    if($valid){
        // escape inputs data
        $kode_brg = $db->real_escape_string($kode_brg);
        $pic = $db->real_escape_string($pic);
        $tanggal = $db->real_escape_string($tanggal);
        $jenis = $db->real_escape_string($jenis);
        $nama = $db->real_escape_string($nama);
        $lokasi = $db->real_escape_string($lokasi);
        $tahun = $db->real_escape_string($tahun);
        $kondisi = $db->real_escape_string($kondisi);
        $keterangan = $db->real_escape_string($keterangan);

        // execute query
        if ($foto_valid) { // jika foto diganti
            $result = $db->query(" UPDATE cek SET jenis_brg='".$jenis."', nama_brg='".$nama."',
                                tahun='".$tahun."', lokasi='".$lokasi."', pic='".$pic."', kondisi='".$kondisi."',
                                keterangan='".$keterangan."', foto='".$foto."' WHERE kode_brg='".$kode_brg."' AND tgl_cek='".$tanggal."' ");
        } else { //jika foto tidak diganti
            $result = $db->query(" UPDATE cek SET jenis_brg='".$jenis."', nama_brg='".$nama."',
                                tahun='".$tahun."', lokasi='".$lokasi."', pic='".$pic."', kondisi='".$kondisi."',
                                keterangan='".$keterangan."' WHERE kode_brg='".$kode_brg."' AND tgl_cek='".$tanggal."' ");
        }

        if (!$result) {
            die ("could not query the database: <br>".$db->error);
        }else {
            // close connection
            $db->close();
            header('Location: tabel-barang.php');
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
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Cek Peralatan</h4>
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
                            <label for="tanggal">Tanggal Cek</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-4">
                            <label for="jenis">Jenis Barang</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $jenis; ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $lokasi; ?>" required>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" value="<?php echo $tahun; ?>" required>
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-4">
                            <label for="kondisi">Kondisi</label>
                            <input type="text" class="form-control" id="kondisi" name="kondisi" value="<?php echo $kondisi; ?>" required>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="form-group col-md-6">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3"><?php echo $keterangan; ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="foto">Upload Foto</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                            <div class="error mt-1" style="color: red;"><?php if (isset($error_foto)) echo $error_foto;?></div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-2 align-self-end">
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
        <?php $result->free();
              $db->close(); ?>
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