<!-- ============================================================== -->
<!-- Check Submit and Session -->
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
require_once 'lib/db_login.php';

if (isset($_POST['submit'])) {
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
    $result = $db->query(" INSERT INTO barang VALUES ('".$kode_brg."','".$jenis."','".$nama."','".$tahun."','".$lokasi."'
    ,'".$pic."') ");

    if (!$result) {
      // die ("could not query the database: <br>".$db->error);
      // close connection
      $db->close();
      header('Location: tabel-barang.php?success=-1');
    }else {
      // close connection
      $db->close();
      header('Location: tabel-barang.php?success=1');
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
        <h4 class="card-title text-center">Tambah Peralatan</h4>
        <br>
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
          <div class="form-row mb-3">
            <div class="form-group col-md-5">
              <label for="kode_brg">Kode Peralatan</label>
              <input type="text" class="form-control" id="kode_brg" name="kode_brg" required>
              <p id="error-kode" style="color: red;"></p>
            </div>
            <div class="form-group col-md-4">
              <label for="pic">PIC</label>
              <input type="text" class="form-control" id="pic" name="pic" value="" required>
            </div>
            <div class="form-group col-md-3">
              <label for="tahun">Tahun</label>
              <input type="text" class="form-control" id="tahun" name="tahun" value="" required>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="form-group col-md-3">
              <label for="jenis">Jenis Barang</label>
              <input type="text" class="form-control" id="jenis" name="jenis" value="" required>
            </div>
            <div class="form-group col-md-4">
              <label for="nama">Nama Barang</label>
              <input type="text" class="form-control" id="nama" name="nama" value="" required>
            </div>
            <div class="form-group col-md-5">
              <label for="lokasi">Lokasi</label>
              <input type="text" class="form-control" id="lokasi" name="lokasi" value="" required>
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