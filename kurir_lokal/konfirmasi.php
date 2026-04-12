<?php
include '../sim_logistik/koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}
$id_pesanan = mysqli_real_escape_string($koneksi, $_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selesaikan'])) {
    $penerima = mysqli_real_escape_string($koneksi, $_POST['nama_penerima']);
    $hubungan = mysqli_real_escape_string($koneksi, $_POST['hubungan']);

    $nama_foto = "bukti_" . time() . ".jpg";

    $q_bukti = "INSERT INTO bukti_serah_terima (id_pesanan, nama_penerima, hubungan, foto_bukti, waktu_terkirim) 
                VALUES ('$id_pesanan', '$penerima', '$hubungan', '$nama_foto', NOW())";
    mysqli_query($koneksi, $q_bukti);

    $q_update = "UPDATE pesanan SET status = 'Selesai' WHERE id_pesanan = '$id_pesanan'";
    mysqli_query($koneksi, $q_update);

    echo "<script>alert('MANTAP! Paket berhasil diserahkan ke $penerima.'); window.location.href='dashboard.php';</script>";
    exit;
}

$q_detail = "SELECT * FROM pesanan WHERE id_pesanan = '$id_pesanan'";
$detail = mysqli_fetch_assoc(mysqli_query($koneksi, $q_detail));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Bukti Serah Terima</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: #F66341;
        }

        .sf-pro {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-white h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full shrink-0 relative z-10 text-white">
            <div class="w-full h-[40px] px-6 flex justify-between items-center">
                <span class="sf-pro font-semibold text-[15px]">9:41</span>
                <div class="w-6 h-3 border border-white/60 rounded-sm relative">
                    <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                </div>
            </div>
            <div class="px-5 py-4 flex items-center gap-3">
                <button onclick="window.history.back()" class="p-1 active:opacity-50 transition-opacity">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>
                <h1 class="text-[18px] font-bold">Bukti Serah Terima</h1>
            </div>
        </div>

        <form method="POST" enctype="multipart/form-data" class="flex-1 overflow-y-auto no-scrollbar px-6 pt-5 pb-32">

            <div class="bg-gray-50 border border-gray-100 rounded-xl p-4 mb-6">
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-1">Resi Paket</p>
                <p class="text-gray-900 font-bold text-[16px] tracking-wide"><?= htmlspecialchars($detail['resi']) ?></p>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 text-[13px] font-bold mb-2">Siapa yang menerima paket?</label>
                    <input type="text" name="nama_penerima" required placeholder="Contoh: Intan (Penerima Asli)" class="w-full bg-white border-2 border-gray-200 focus:border-[#F66341] rounded-xl px-4 py-3.5 outline-none font-medium text-gray-800 text-[14px] transition-colors">
                </div>

                <div>
                    <label class="block text-gray-700 text-[13px] font-bold mb-2">Hubungan dengan Penerima</label>
                    <select name="hubungan" required class="w-full bg-white border-2 border-gray-200 focus:border-[#F66341] rounded-xl px-4 py-3.5 outline-none font-medium text-gray-800 text-[14px] appearance-none">
                        <option value="Yang Bersangkutan">Yang Bersangkutan Sendiri</option>
                        <option value="Keluarga/Kerabat">Keluarga / Kerabat</option>
                        <option value="Satpam/Resepsionis">Satpam / Resepsionis</option>
                        <option value="Tetangga">Tetangga</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-[13px] font-bold mb-2 mt-2">Upload Foto Bukti</label>
                    <div class="w-full h-[140px] bg-orange-50/50 border-2 border-dashed border-[#F66341]/40 rounded-xl flex flex-col items-center justify-center text-[#F66341] relative overflow-hidden active:bg-orange-50 transition-colors">
                        <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-[13px] font-bold">Ambil Foto Paket</span>
                        <input type="file" name="foto_bukti" accept="image/*" capture="environment" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white p-5 border-t border-gray-50 shadow-[0_-10px_20px_rgba(0,0,0,0.03)] z-50">
                <button type="submit" name="selesaikan" class="w-full shopee-bg text-white h-[52px] rounded-xl font-bold text-[14px] shadow-lg shadow-orange-200 active:scale-[0.98] transition-all tracking-wide">
                    KONFIRMASI TERKIRIM
                </button>
            </div>
        </form>
    </div>
</body>

</html>