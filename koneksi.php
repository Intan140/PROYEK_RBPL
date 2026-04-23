<?php
$host = "sql305.infinityfree.com";
$user = "if0_41724027";
$pass = "halloRBPL";
$db   = "if0_41724027_db_logistik";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>