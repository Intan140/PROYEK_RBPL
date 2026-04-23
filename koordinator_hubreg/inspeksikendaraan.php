<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $kondisi_ban = isset($_POST['kondisi_ban']) ? 1 : 0;
    $fungsi_rem = isset($_POST['fungsi_rem']) ? 1 : 0;
    $lampu_sinyal = isset($_POST['lampu_sinyal']) ? 1 : 0;
    $hasil_inspeksi = mysqli_real_escape_string($koneksi, $_POST['hasil_inspeksi']);
    $komentar = mysqli_real_escape_string($koneksi, $_POST['komentar']);

    $query = "INSERT INTO inspeksi_kendaraan (kondisi_ban, fungsi_rem, lampu_sinyal, hasil_inspeksi, komentar) 
              VALUES ('$kondisi_ban', '$fungsi_rem', '$lampu_sinyal', '$hasil_inspeksi', '$komentar')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Laporan inspeksi armada berhasil disimpan!'); window.location.href='dashboard.php';</script>";
        exit;
    } else {

        if (mysqli_errno($koneksi) == 1146) {
            echo "<script>alert('Error: Tabel inspeksi_kendaraan belum dibuat di Database!');</script>";
        } else {
            echo "<script>alert('Gagal menyimpan: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Inspeksi Kendaraan - Admin Middle Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #ee4d2d;
        }

        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Roboto', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        .font-app-bar {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 18px;
            color: white;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .shopee-text {
            color: var(--shopee-orange);
        }

        .form-card {
            background: white;
            box-shadow: 2px 0px 10px rgba(3, 3, 3, 0.10);
            border-radius: 8px;
            border: 0.5px solid rgba(0, 0, 0, 0.20);
        }

        .input-field {
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .input-field:focus-within {
            border-color: var(--shopee-orange);
        }

        .nav-shadow {
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.05);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: #9ca3af;
            text-decoration: none;
        }

        .nav-item.active {
            color: var(--shopee-orange);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--shopee-orange);
            cursor: pointer;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#f5f5f5] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full shrink-0">
            <div class="px-5 pt-2 flex justify-between items-center text-white text-xs font-semibold">
                <span>9:41</span>
                <div class="flex items-center gap-1.5">
                    <div class="w-5 h-2.5 border border-white/60 rounded-sm relative">
                        <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                    </div>
                </div>
            </div>
            <div class="px-4 pt-4 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="dashboard.php">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h1 class="font-app-bar">Audit & Inspeksi</h1>
                </div>
            </div>
        </div>

        <form method="POST" action="" class="flex-1 overflow-y-auto no-scrollbar px-6 pt-6 pb-32">
            <h2 class="font-poppins text-[#030303] text-[20px] mb-6 font-semibold">Inspeksi Kendaraan</h2>

            <div class="form-card p-5 mb-6">
                <h3 class="font-poppins font-semibold text-[16px] text-[#030303] mb-4">Checklist Inspeksi</h3>
                <div class="space-y-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="kondisi_ban" value="1">
                        <span class="font-montserrat text-[14px] text-[#030303]">Kondisi Ban Baik</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="fungsi_rem" value="1">
                        <span class="font-montserrat text-[14px] text-[#030303]">Fungsi Rem Berjalan</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="lampu_sinyal" value="1">
                        <span class="font-montserrat text-[14px] text-[#030303]">Lampu dan Sinyal Normal</span>
                    </label>
                </div>
            </div>

            <div class="form-card p-5 mb-6">
                <h3 class="font-poppins font-semibold text-[16px] text-[#030303] mb-3">Hasil Inspeksi</h3>
                <div class="input-field bg-white h-[42px] flex items-center px-3">
                    <input type="text" name="hasil_inspeksi" required placeholder="Contoh: Lulus Uji Jalan" class="w-full bg-transparent outline-none font-montserrat text-[14px] placeholder-[#94A3B8]">
                </div>
            </div>

            <div class="form-card p-5 mb-8">
                <h3 class="font-montserrat font-semibold text-[16px] text-[#030303] mb-3">Komentar / Catatan</h3>
                <div class="input-field bg-white h-[99px] p-3">
                    <textarea name="komentar" placeholder="Tambahkan catatan mekanik jika ada..." class="w-full h-full bg-transparent outline-none font-montserrat text-[14px] placeholder-[#94A3B8] resize-none"></textarea>
                </div>
            </div>

            <button type="submit" class="w-full shopee-bg text-white h-[48px] rounded-lg font-montserrat font-bold text-[14px] shadow-lg active:scale-95 transition-all">
                KIRIM LAPORAN INSPEKSI
            </button>
        </form>

        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white border-t border-gray-100 h-16 flex justify-around items-center px-2 z-[100] nav-shadow">
            <a href="dashboard.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px] font-medium">Beranda</span>
            </a>
        </nav>
    </div>
</body>

</html>