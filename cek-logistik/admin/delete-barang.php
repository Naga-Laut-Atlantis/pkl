<?php
  // melakukan query untuk menghapus barang dari db dan menghapus foto di direktori
  session_start(); // resume session
  if (!isset($_SESSION['kode'])) { // cek session
    header('Location: ../login.php');
  }else {
    if($_SESSION['role'] == 'PIC'){
      header('Location: ../');
    }
  }

  $kode_brg = $_GET['kode_brg'];
  // include login information
  require_once('lib/db_login.php');

  // execute query 
  $result = $db->query(" DELETE FROM barang WHERE kode_brg='".$kode_brg."' ");
  if (!$result) {
    // die ("Could not query the database: <br>".$db->error);
    $db->close();
    header('Location: tabel-barang.php?success=-3');
  }else {
    $db->close();
    header('Location: tabel-barang.php?success=3');
  }
  // #close db connection
  // $db->close();
?>