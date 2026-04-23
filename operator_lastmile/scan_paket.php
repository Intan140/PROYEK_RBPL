<?php
include '../koneksi.php';

$data_paket = null;
$pesan = '';
$tipe_pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cari_resi'])) {
    $resi = mysqli_real_escape_string($koneksi, $_POST['resi']);

    $query = "SELECT * FROM pesanan WHERE resi = '$resi'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data_paket = mysqli_fetch_assoc($result);
    } else {
        $pesan = "Resi $resi tidak ditemukan!";
        $tipe_pesan = "error";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan_paket'])) {
    $resi_simpan = mysqli_real_escape_string($koneksi, $_POST['resi_simpan']);

    $update = "UPDATE pesanan SET status = 'Tiba di Hub Tujuan' WHERE resi = '$resi_simpan'";
    if (mysqli_query($koneksi, $update)) {
        $pesan = "Berhasil! Paket $resi_simpan telah Tiba di Hub Tujuan.";
        $tipe_pesan = "success";

        $data_paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pesanan WHERE resi = '$resi_simpan'"));
    } else {
        $pesan = "Gagal menyimpan data!";
        $tipe_pesan = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Scan Barcode - Kurir Last Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: #F66341;
        }

        .shopee-text {
            color: #F66341;
        }

        .shopee-border {
            border-color: #F66341;
        }

        /* Scanner Simulation Styles */
        .scanner-area {
            position: relative;
            background: #F66341;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(246, 99, 65, 0.4);
        }

        .scanner-line {
            position: absolute;
            width: 100%;
            height: 3px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 20px 4px rgba(255, 255, 255, 0.8);
            top: 0;
            animation: scan 2.5s infinite linear;
        }

        @keyframes scan {
            0% {
                top: 0%;
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            50% {
                top: 100%;
                opacity: 1;
            }

            60% {
                opacity: 0;
            }

            100% {
                top: 0%;
                opacity: 0;
            }
        }

        .label-style {
            color: #64748b;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
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

    <div class="w-full max-w-[400px] bg-white min-h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="w-full h-[40px] px-6 flex justify-between items-center bg-white shrink-0">
            <span class="sf-pro font-semibold text-[15px]">9:41</span>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="black" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 2a1 1 0 011-1h2a1 1 0 011 1v14a1 1 0 01-1 1h-2a1 1 0 01-1-1V2z" />
                </svg>
                <div class="w-6 h-3 border border-black/30 rounded-sm relative">
                    <div class="absolute inset-0.5 bg-black w-3/4 rounded-px"></div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 flex items-center gap-4 shrink-0">
            <button onclick="window.location.href='dashboard.php'" class="p-1 active:opacity-50 transition-opacity">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 9H3M3 9L8 14M3 9L8 4" stroke="#030303" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <h1 class="text-[20px] font-bold text-[#030303]">Scan Kedatangan</h1>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar pb-32">

            <div class="px-6 mt-2">
                <div class="scanner-area w-full h-[220px] flex items-center justify-center">

                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center border border-white/40 backdrop-blur-sm z-10">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                            <path d="M3 7V5a2 2 0 012-2h2M17 3h2a2 2 0 012 2v2M21 17v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2" stroke-linecap="round" stroke-linejoin="round" />
                            <rect x="7" y="7" width="10" height="10" rx="1.5" />
                        </svg>
                    </div>

                    <div class="scanner-line"></div>
                </div>
            </div>

            <div class="px-6 mt-6">
                <form method="POST" action="">
                    <label class="block text-[12px] font-bold text-gray-400 uppercase tracking-wider mb-2">Masukkan / Scan Resi</label>
                    <div class="relative">
                        <input type="text" name="resi" required autofocus value="<?= isset($_POST['resi']) ? htmlspecialchars($_POST['resi']) : '' ?>" placeholder="Contoh: RESI202603221724" class="w-full h-[48px] bg-gray-50 border-2 border-gray-100 rounded-xl px-4 font-poppins text-[14px] outline-none transition-all focus:border-[#F66341] font-medium text-gray-800">
                        <button type="submit" name="cari_resi" class="absolute right-2 top-1.5 bottom-1.5 px-4 bg-[#F66341] text-white rounded-lg font-bold text-[12px] shadow-md active:scale-95 transition-all">CARI</button>
                    </div>
                </form>
            </div>

            <div class="px-6 mt-6 space-y-3">
                <?php if ($pesan): ?>
                    <div class="p-3 mb-2 rounded-lg text-sm font-semibold flex items-center gap-2 <?= $tipe_pesan == 'success' ? 'bg-green-50 text-green-600 border border-green-200' : 'bg-red-50 text-red-600 border border-red-200' ?>">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $tipe_pesan == 'success' ? 'M5 13l4 4L19 7' : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' ?>"></path>
                        </svg>
                        <span><?= $pesan ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($data_paket): ?>
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5 space-y-3">
                        <p class="label-style flex flex-col gap-0.5">Nomor Resi
                            <span class="font-bold text-gray-900 text-[16px] tracking-wide"><?= htmlspecialchars($data_paket['resi']) ?></span>
                        </p>
                        <p class="label-style flex flex-col gap-0.5">Nama Produk
                            <span class="font-semibold text-gray-800 text-[15px]"><?= htmlspecialchars($data_paket['nama_produk']) ?></span>
                        </p>
                        <p class="label-style flex flex-col gap-0.5">Alamat Tujuan
                            <span class="font-medium text-gray-800 text-[14px] leading-snug"><?= htmlspecialchars($data_paket['alamat']) ?></span>
                        </p>

                        <div class="flex gap-4 pt-2 border-t border-gray-200 mt-3">
                            <p class="label-style flex flex-col gap-0.5 flex-1">Jumlah
                                <span class="font-bold text-gray-900 text-[15px]"><?= htmlspecialchars($data_paket['jumlah']) ?> pcs</span>
                            </p>
                            <p class="label-style flex flex-col gap-0.5 flex-1 border-l border-gray-200 pl-4">Berat
                                <span class="font-bold text-gray-900 text-[15px]"><?= htmlspecialchars($data_paket['berat']) ?> kg</span>
                            </p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex flex-col items-center justify-center py-8 opacity-40">
                        <svg class="w-12 h-12 text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                        <p class="font-medium text-gray-500 text-sm">Menunggu scan paket...</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white p-5 flex justify-between items-center gap-3 border-t border-gray-100 z-50 shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">

            <button onclick="window.location.href='sortir.php'" class="flex-1 h-[48px] border-2 border-[#F66341] text-[#F66341] font-poppins font-bold text-[14px] rounded-xl active:bg-orange-50 transition-colors shadow-sm">
                Ke Sortir
            </button>

            <form method="POST" action="" class="flex-1 flex">
                <input type="hidden" name="resi_simpan" value="<?= $data_paket ? $data_paket['resi'] : '' ?>">
                <button type="submit" name="simpan_paket" <?= !$data_paket ? 'disabled' : '' ?> class="w-full h-[48px] bg-[#F66341] text-white font-poppins font-bold text-[14px] rounded-xl shadow-lg shadow-orange-200 active:scale-95 transition-all disabled:opacity-50 disabled:active:scale-100 disabled:cursor-not-allowed">
                    Simpan (Tiba)
                </button>
            </form>
        </div>

    </div>
</body>

</html>
