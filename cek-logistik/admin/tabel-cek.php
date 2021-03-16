<!-- ============================================================== -->
<!-- Cek Session -->
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
$bulanLalu = date("Y-m-d", strtotime("-1 Months"));
?>
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
            <div class="col-sm-12">
                <?php
                if (isset($_GET['success'])) {
                    switch ($_GET['success']) {
                        case '1':
                            echo '<div class="alert alert-success alert-dismissible fade show">
                                    <strong>Sukses!</strong> Cek Barang berhasil ditambahkan.<br>';
                            break; 
                        case '-1':
                            echo '<div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Gagal!</strong> Cek Barang gagal ditambahkan.<br>';
                            break;
                        case '2':
                            echo '<div class="alert alert-success alert-dismissible fade show">
                                    <strong>Sukses!</strong> Cek Barang berhasil diedit.<br>';
                            break;
                        case '-2':
                            echo '<div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Gagal!</strong> Cek Barang gagal diedit.<br>';
                            break;
                        case '3':
                            echo '<div class="alert alert-success alert-dismissible fade show">
                                    <strong>Sukses!</strong> Cek Barang berhasil dihapus.<br>';
                            break;
                        case '-3':
                            echo '<div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Gagal!</strong> Cek Barang gagal dihapus.<br>';
                            break;
                    }  
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                } ?>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="" method="POST" class="form-horizontal form-material">
                    <div class="form-row pb-2">
                        <div class="form-group col-md-3 mr-2">
                            <label for="tanggal-awal">Dari Tanggal</label>
                            <input type="date" name="tanggal-awal" id="tanggal-awal" class="form-control form-control-line" value="<?php if (isset($tanggal_awal)) {
                                                                                                                                        echo $tanggal_awal;
                                                                                                                                    } else {
                                                                                                                                        echo $bulanLalu;
                                                                                                                                    } ?>">
                        </div>
                        <div class="form-group col-md-3 mr-2">
                            <label for="tanggal-awal">Sampai Tanggal</label>
                            <input type="date" name="tanggal-akhir" id="tanggal-akhir" class="form-control form-control-line" value="<?php if (isset($tanggal_akhir)) {
                                                                                                                                        echo $tanggal_akhir;
                                                                                                                                    } else {
                                                                                                                                        echo $tglSekarang;
                                                                                                                                    } ?>">
                        </div>
                        <div class="col-md-2 my-auto">
                            <button type="submit" class="btn btn-primary" id="submit" name="submit" style="font-size: 120%;">Tampil</button>
                        </div>
                        <div class="col-md-3 my-auto">
                            <a href="add-cek.php" type="button" class="btn btn-primary float-right d-inline-block float-right" style="font-size: 130%;"><i class="fas fa-plus"></i>&nbsp;Cek Peralatan</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center" style="font-size: 200%;">Tabel Cek Peralatan Logistik</h4>
                <div class="table-responsive-sm">
                    <table class="table user-table" id="tabel-print" style="table-layout: auto;">
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
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (isset($tanggal_awal)) {
                                $query = " SELECT * FROM cek WHERE tgl_cek BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' ORDER BY tgl_cek DESC ";
                            } else {
                                $query = " SELECT * FROM cek WHERE tgl_cek BETWEEN '".$bulanLalu."' AND '".$tglSekarang."' ORDER BY tgl_cek DESC ";
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
                                    echo '<td>
                                            <div class="btn-group-vertical">
                                                <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#fotoModalAdmin" data-whatever="'.$row->foto.'">Foto</button>
                                                <a href="edit-cek.php?kode_brg='.$row->kode_brg.'&tgl='.$row->tgl_cek.'" type="button" class="btn btn-warning text-white ">Edit</a>
                                                <button type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#hapusModal" data-whatever="'.$row->kode_brg.'" data-whatever1="'.$row->tgl_cek.'">Hapus</button>
                                            </div>
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
        <!-- ============================================================== -->
        <!-- End PAge Content -->
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