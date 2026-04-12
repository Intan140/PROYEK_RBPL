<?php
header('Content-Type: application/json');
include '../sim_logistik/koneksi.php';

$id_resi = isset($_GET['id_resi']) ? mysqli_real_escape_string($koneksi, $_GET['id_resi']) : '';

if ($id_resi == '') {
    echo json_encode(["error" => true, "pesan" => "Resi kosong"]);
    exit;
}

$query = mysqli_query($koneksi, "
    SELECT 
        pesanan.resi, 
        pesanan.nama_produk, 
        pesanan.berat, 
        pelanggan.nama AS nama_penerima, 
        pelanggan.alamat,
        pesanan.jumlah
    FROM pesanan 
    JOIN pelanggan ON pesanan.id_penerima = pelanggan.id_pelanggan 
    WHERE pesanan.resi='$id_resi'
");

$data = mysqli_fetch_assoc($query);

if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(["error" => true, "pesan" => "Resi tidak ditemukan"]);
}
