<?php
include '../koneksi.php';

//SPRINT 9 - TASK (PBI-042)

if (isset($_GET['id'])) {
    $id_pesanan = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "SELECT p.*, pel.nama as nama_penerima, pel.alamat as alamat_penerima 
                                   FROM pesanan p 
                                   JOIN pelanggan pel ON p.id_penerima = pel.id_pelanggan 
                                   WHERE p.id_pesanan = '$id_pesanan'");
    $data = mysqli_fetch_assoc($query);

    if ($data['status'] !== 'Menunggu Pickup') {
        echo "<script>alert('Pesanan yang sudah diproses tidak dapat diubah!'); window.location.href='daftarpesanan.php';</script>";
        exit;
    }
}

// 2. Proses Update Data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pesanan = $_POST['id_pesanan'];
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    $berat = mysqli_real_escape_string($koneksi, $_POST['berat']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $update = mysqli_query($koneksi, "UPDATE pesanan SET 
                nama_produk = '$nama_produk', 
                jumlah = '$jumlah', 
                berat = '$berat', 
                alamat = '$alamat' 
                WHERE id_pesanan = '$id_pesanan'");

    if ($update) {
        echo "<script>alert('Data Pesanan Berhasil Diperbarui!'); window.location.href='daftarpesanan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan - Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f5f5f5; }
        .shopee-orange { background-color: #ee4d2d; }
    </style>
</head>
<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-white h-screen shadow-lg flex flex-col">
        <!-- Header -->
        <div class="shopee-orange p-4 flex items-center gap-3 text-white">
            <a href="daftarpesanan.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-medium">Edit Rincian Pesanan</h1>
        </div>

        <!-- Form -->
        <form action="" method="POST" class="p-6 space-y-4 overflow-y-auto">
            <input type="hidden" name="id_pesanan" value="<?= $data['id_pesanan'] ?>">
            
            <div>
                <label class="text-xs text-gray-500 font-semibold uppercase">Nomor Resi</label>
                <p class="text-sm font-bold text-gray-800"><?= $data['resi'] ?></p>
            </div>

            <div class="space-y-1">
                <label class="text-sm text-gray-600">Nama Produk</label>
                <input type="text" name="nama_produk" value="<?= $data['nama_produk'] ?>" required class="w-full border-b border-gray-300 py-2 outline-none focus:border-orange-500 transition-colors">
            </div>

            <div class="flex gap-4">
                <div class="flex-1 space-y-1">
                    <label class="text-sm text-gray-600">Jumlah</label>
                    <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" required class="w-full border-b border-gray-300 py-2 outline-none focus:border-orange-500">
                </div>
                <div class="flex-1 space-y-1">
                    <label class="text-sm text-gray-600">Berat (kg)</label>
                    <input type="text" name="berat" value="<?= $data['berat'] ?>" required class="w-full border-b border-gray-300 py-2 outline-none focus:border-orange-500">
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-sm text-gray-600">Alamat Pengiriman</label>
                <textarea name="alamat" required rows="3" class="w-full border border-gray-300 rounded-md p-2 text-sm outline-none focus:border-orange-500"><?= $data['alamat'] ?></textarea>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full shopee-orange text-white py-3 rounded-md font-bold shadow-md active:scale-95 transition-all">
                    SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>
</body>
</html>
