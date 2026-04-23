<?php
include '../koneksi.php';

$id_resi = isset($_POST['id_resi']) ? mysqli_real_escape_string($koneksi, $_POST['id_resi']) : '';

$query = mysqli_query($koneksi, "
    UPDATE pesanan 
    SET status='Picked Up'
    WHERE resi='$id_resi'
");

if (mysqli_affected_rows($koneksi) > 0) {
    echo "berhasil";
} else {
    echo "gagal / resi tidak ditemukan atau status sudah Picked Up sebelumnya";
}
