<!-- ============================================================== -->
<!-- Check Submit -->
<!-- ============================================================== -->
<?php
// Login untuk mendapat session user
session_start(); // inisialisasi sesssion
require_once 'lib/db_login.php';

if (isset($_POST["submit"])) {
    $kode = test_input($_POST['kode']);
    $password = test_input($_POST['password']);

    // execute the query
    $result = $db->query(" SELECT * FROM user WHERE kode='".$kode."' AND password='".md5($password)."' ");
    if (!$result) {
        die ("Could not query the database: <br>".$db->error);
    }else {
        if ($result->num_rows > 0) { // login berhasil
            $row = $result->fetch_object();
            $_SESSION['kode'] = $row->kode;
            $_SESSION['nama'] = $row->nama;
            $_SESSION['role'] = $row->jabatan;
            $result->free();
            if ($row->jabatan == 'PIC') {
                header('Location: ./');
            }else {
                header('Location: admin/');
            }
            exit;
        }else {
            $error_login = '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                <strong>Kombinasi Username dan Password salah!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
        }
    }
    #close db connection
    $db->close();
}
?>
<!-- ============================================================== -->
<!-- Require Header -->
<!-- ============================================================== -->
<?php require_once "lib/header.php"; ?>
<!-- | | | | Topbar.php | | | | -->
<!-- V V V V            V V V V -->
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin6">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="../assets/images/logo-erlangga.png" alt="homepage" class="dark-logo" style="max-width: 200px;" />
                    </b>
                    <!--End Logo icon -->
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper ml-0">
        <!-- ============================================================== -->
        <!-- Alert -->
        <!-- ============================================================== -->
        <div id="alert-login"><?php if (isset($error_login)) echo $error_login; ?></div>
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="card mx-auto" style="max-width: 350px; margin-top: 7%; margin-bottom: 12%;">
                <div class="card-header text-white bg-info" style="font-size: 150%;"><i class="fas fa-sign-in-alt mr-1"></i>&nbsp;Cek Peralatan Logistik</div>
                <div class="card-body">
                    <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="kode" name="kode" value="" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="submit" value="submit">Login</button>
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