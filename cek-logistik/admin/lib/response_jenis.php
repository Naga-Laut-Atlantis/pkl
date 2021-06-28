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

$term = $_GET["term"];
// execute query
$result = $db->query(" SELECT DISTINCT jenis_brg FROM barang ");

$jenis = array();
while ($row = $result->fetch_object()) {
  array_push($jenis, $row->jenis_brg);
}

$json = array();
foreach ($jenis as $j) {
  if(strpos(strtoupper($j),strtoupper($term))!== false){
    array_push($json, $j);
  }
}

echo json_encode($json);
?>