<?php
// logout untuk destroy session

session_start();
if (isset($_SESSION['kode'])) {
    unset($_SESSION['kode']);
    unset($_SESSION['nama']);
    session_destroy();
}
header('Location: login.php');
?>