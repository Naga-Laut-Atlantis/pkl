<?php
$db_host='localhost';
$db_database='logistik';
$db_username='archerx';
$db_password='MySQLpasw0&';

// connect database
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Could not connect to the database: <br />". $db->connect_error);
}

function test_input($data) {
   if (isset($data)) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }else {
      return null;
   }
}
?>
