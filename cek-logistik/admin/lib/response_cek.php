<?php
session_start(); // resume session
if (!isset($_SESSION['kode'])) { // cek session
  header('Location: ../../login.php');
}else {
  if($_SESSION['role'] == 'PIC'){
      header('Location: ../../');
  }
}

require_once('db_login.php');

$kode = $_GET['kode'];
// execute query
$result = $db->query(" SELECT * FROM barang WHERE kode_brg='".$kode."' ");
if ($result->num_rows > 0) {
    $row = $result->fetch_object();
    $data = array(
        'jenis' => $row->jenis_brg,
        'nama'  => $row->nama_brg,
        'tahun' => $row->tahun,
        'lokasi'=> $row->lokasi,
        'pic'   => $row->pic,
        'error' => '');
}else {
    $data = array(
        'jenis' => '',
        'nama'  => '',
        'tahun' => '',
        'lokasi'=> '',
        'pic'   => '',
        'error' => 'Kode tidak ditemukan');
}
echo json_encode($data);
$result->free();
$db->close();
?>