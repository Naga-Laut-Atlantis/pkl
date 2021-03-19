<?php
    // melakukan query untuk menghapus barang dari db dan menghapus foto di direktori
    session_start(); // resume session
    if (!isset($_SESSION['kode'])) { // cek session
        header('Location: login.php');
    }else {
        if($_SESSION['role'] != 'PIC'){
            header('Location: admin/');
        }
    }

    $kode_brg = $_GET['kode_brg'];
    $tgl_cek = $_GET['tgl'];
    // include login information
    require_once('lib/db_login.php');

    // delete foto di direktori
    $target_dir = "../assets/images/upload/";
    $result_foto = $db->query(" SELECT foto FROM cek WHERE kode_brg='".$kode_brg."' AND tgl_cek='".$tgl_cek."' ");
    $row_foto = $result_foto->fetch_object();
    unlink($target_dir.$row_foto->foto);
    // execute query 
    $result = $db->query(" DELETE FROM cek WHERE kode_brg='".$kode_brg."' AND tgl_cek='".$tgl_cek."' ");
    if (!$result) {
        // die ("Could not query the database: <br>".$db->error);
        $result_foto->free();
        $db->close();
        header('Location: ./?success=-3');
    }else {
        $result_foto->free();
        $db->close();
        header('Location: ./?success=3');
    }
    #close db connection
    $db->close();
?>