<?php
include '../sim_logistik/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_pengirim = 1;


    $nama_penerima = mysqli_real_escape_string($koneksi, $_POST['nama_penerima']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $nama_produk   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jumlah        = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    $berat         = mysqli_real_escape_string($koneksi, $_POST['berat']);
    $tanggal       = mysqli_real_escape_string($koneksi, $_POST['tanggal']);

    $cek = mysqli_query($koneksi, "SELECT * FROM pelanggan 
                                  WHERE nama='$nama_penerima' 
                                  AND alamat='$alamat'");

    if (mysqli_num_rows($cek) > 0) {
        $data = mysqli_fetch_assoc($cek);
        $id_penerima = $data['id_pelanggan'];
    } else {
        mysqli_query($koneksi, "INSERT INTO pelanggan (nama, alamat) 
                                VALUES ('$nama_penerima', '$alamat')");
        $id_penerima = mysqli_insert_id($koneksi);
    }


    $resi = "RESI" . date("YmdHis") . rand(100, 999);
    $status_awal = "Menunggu Pickup";


    $query = "INSERT INTO pesanan 
    (id_pengirim, id_penerima, nama_produk, berat, jumlah, tanggal, status, resi, alamat)
    VALUES
    ('$id_pengirim', '$id_penerima', '$nama_produk', '$berat', '$jumlah', '$tanggal', '$status_awal', '$resi', '$alamat')";

    if (mysqli_query($koneksi, $query)) {

        echo "<script>alert('Pesanan Berhasil Dibuat! Resi: $resi'); window.location.href='daftarpesanan.php';</script>";
    } else {

        echo "Error Simpan Pesanan: " . mysqli_error($koneksi);
    }
} else {

    header("Location: formdetailproduk.php");
}
