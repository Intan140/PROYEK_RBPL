<?php
// Memanggil koneksi dari folder sim_logistik
include '../sim_logistik/koneksi.php';

$data_paket = null;
$error_msg = "";

// PBI-010 & PBI-012: Logic Pencarian berdasarkan Resi
if (isset($_GET['resi']) && !empty($_GET['resi'])) {
    $resi = mysqli_real_escape_string($koneksi, $_GET['resi']);
    $query = "SELECT * FROM pesanan WHERE resi = '$resi'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $data_paket = mysqli_fetch_assoc($result);
    } else {
        $error_msg = "Paket dengan resi $resi tidak ditemukan.";
    }
}

// PBI-011 & PBI-013: Logic Update Status (Teruskan ke Hub Regional)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id_pesanan = mysqli_real_escape_string($koneksi, $_POST['id_pesanan']);

    // Logic Klasifikasi Sederhana: Set status baru
    $status_baru = "Menuju Hub Regional";

    $update_query = "UPDATE pesanan SET status = '$status_baru' WHERE id_pesanan = '$id_pesanan'";
    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Status paket berhasil diperbarui!'); window.location.href='statussortir.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui status: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Sortation Center - Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #F66341;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        .font-status {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Text", sans-serif;
        }

        .font-jakarta {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .shopee-text {
            color: var(--shopee-orange);
        }

        .glass-card {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .input-focus:focus {
            outline: none;
            border-color: var(--shopee-orange);
            box-shadow: 0 0 0 2px rgba(246, 99, 65, 0.1);
        }

        .image-container {
            width: 100%;
            height: 180px;
            background-color: #f1f5f9;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#fdfdfd] min-h-screen relative shadow-2xl overflow-hidden flex flex-col no-scrollbar border-x border-gray-100">

        <div class="shopee-bg w-full h-[120px] absolute top-0 left-0 z-0"></div>

        <div class="relative z-10 w-full h-[40px] px-6 flex justify-between items-center mt-1">
            <span class="font-status text-white text-[16px] font-semibold leading-[21px]">9:41</span>
            <div class="flex items-center gap-2">
                <svg width="17" height="11" viewBox="0 0 17 11" fill="none">
                    <path d="M1 5C3.5 2 7.5 2 10 5M1 8C2.5 6.5 4.5 6.5 6 8" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
                <div class="w-6 h-3 border-2 border-white/40 rounded-[3px] relative">
                    <div class="absolute inset-[1px] bg-white w-[70%] rounded-[1px]"></div>
                </div>
            </div>
        </div>

        <div class="px-6 mt-4 flex items-center gap-4 relative z-10">
            <a href="obsortasi.php" class="flex items-center justify-center active:scale-90 transition w-8 h-8">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <h1 class="text-white text-[20px] font-medium font-poppins">Scan Paket Masuk</h1>
        </div>

        <div class="relative z-10 px-6 mt-6">
            <div class="glass-card rounded-[20px] p-4">
                <form method="GET" action="" class="relative flex items-center">
                    <input type="text" name="resi" value="<?= isset($_GET['resi']) ? htmlspecialchars($_GET['resi']) : '' ?>" placeholder="Scan barcode atau masukkan resi"
                        class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3.5 pl-11 pr-4 text-[14px] font-montserrat text-gray-900 placeholder-[#94A3B8] input-focus transition-all" required autofocus>
                    <div class="absolute left-4">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="submit" class="absolute right-3 shopee-bg p-1.5 rounded-lg active:scale-90 transition-transform">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                            <path d="M3 7V5a2 2 0 012-2h2m10 0h2a2 2 0 012 2v2m0 10v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="relative z-10 px-6 mt-8 flex-1 overflow-y-auto no-scrollbar pb-32">

            <?php if ($error_msg): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-xl text-center text-sm font-montserrat mb-4 border border-red-100">
                    <?= $error_msg ?>
                </div>
            <?php endif; ?>

            <?php if ($data_paket): ?>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-[#030303] text-[20px] font-normal font-montserrat">Informasi Paket</h2>
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                </div>

                <div class="glass-card rounded-[24px] p-6 mb-6">
                    <div class="image-container">
                        <img src="https://placehold.co/600x400/f1f5f9/475569?text=Paket+<?= $data_paket['id_pesanan'] ?>" class="w-full h-full object-cover" alt="Foto Paket">
                        <div class="absolute bottom-3 right-3 bg-black/50 backdrop-blur-md px-3 py-1 rounded-full">
                            <span class="text-white text-[10px] font-bold font-montserrat uppercase tracking-tight">LIVE CAM</span>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="flex flex-col gap-1">
                            <span class="text-[#030303] text-[14px] font-normal font-montserrat opacity-60 uppercase tracking-wider">Tujuan:</span>
                            <p class="text-[#030303] text-[14px] font-normal font-montserrat leading-relaxed"><?= htmlspecialchars($data_paket['alamat']) ?></p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[#030303] text-[14px] font-normal font-montserrat opacity-60 uppercase tracking-wider">Produk:</span>
                            <p class="text-[#030303] text-[14px] font-normal font-montserrat leading-relaxed font-semibold"><?= htmlspecialchars($data_paket['nama_produk']) ?> (<?= htmlspecialchars($data_paket['jumlah']) ?> pcs)</p>
                        </div>

                        <div class="h-[1px] bg-gray-50 w-full"></div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <span class="text-[#030303] text-[14px] font-normal font-montserrat opacity-60 uppercase tracking-wider">Status:</span>
                                <p class="text-[#16A34A] text-[14px] font-normal font-montserrat font-semibold"><?= htmlspecialchars($data_paket['status']) ?></p>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-[#030303] text-[14px] font-normal font-montserrat opacity-60 uppercase tracking-wider">Berat:</span>
                                <p class="text-[#030303] text-[14px] font-normal font-montserrat font-semibold"><?= htmlspecialchars($data_paket['berat']) ?> kg</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="">
                    <input type="hidden" name="id_pesanan" value="<?= $data_paket['id_pesanan'] ?>">
                    <button type="submit" name="update_status" class="w-full shopee-bg text-white h-[56px] rounded-xl flex items-center justify-center gap-3 shadow-lg active:scale-95 transition-all">
                        <span class="text-[14px] font-bold font-jakarta tracking-wide uppercase">TERUSKAN KE HUB REGIONAL</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

            <?php else: ?>
                <div class="flex flex-col items-center justify-center h-48 opacity-50">
                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <p class="font-montserrat text-sm text-center">Scan barcode resi untuk mulai<br>proses klasifikasi paket.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] h-[85px] bg-white shadow-[0_-10px_40px_rgba(0,0,0,0.06)] rounded-t-[32px] flex justify-around items-center z-50 border-t border-gray-50">
            <button class="flex flex-col items-center gap-1.5 px-4 transition-all active:scale-95">
                <svg class="w-6 h-6 shopee-text" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 00.707-1.707l-9-9a.999.999 0 00-1.414 0l-9 9A1 1 0 003 13zm7 7v-5h4v5h-4z" />
                </svg>
                <span class="text-[10px] font-bold shopee-text font-jakarta tracking-wider uppercase">Beranda</span>
            </button>
            <div class="relative">
                <button class="shopee-bg w-[58px] h-[54px] -mt-12 rounded-[20px] flex items-center justify-center shadow-2xl shadow-orange-300 border-[4px] border-white active:scale-90 transition-all">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
            </div>
            <a href="statussortir.php" class="flex flex-col items-center gap-1.5 px-4 opacity-25 transition-all active:scale-95 no-underline">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <span class="text-[10px] font-bold text-gray-800 font-jakarta tracking-wider uppercase text-center">Daftar Sortir</span>
            </a>
        </div>
    </div>
</body>

</html>