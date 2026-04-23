<?php
include '../koneksi.php';

if (!isset($_GET['resi']) || empty($_GET['resi'])) {
    header("Location: index.php");
    exit;
}

$resi = mysqli_real_escape_string($koneksi, $_GET['resi']);

$query = "SELECT * FROM pesanan WHERE resi = '$resi'";
$result = mysqli_query($koneksi, $query);
$paket = mysqli_fetch_assoc($result);

$step = 1;
if ($paket) {
    $status_str = strtolower($paket['status']);
    if (strpos($status_str, 'selesai') !== false || strpos($status_str, 'terkirim') !== false) {
        $step = 4;
    } elseif (strpos($status_str, 'out') !== false || strpos($status_str, 'kurir') !== false) {
        $step = 3;
    } elseif (strpos($status_str, 'hub') !== false || strpos($status_str, 'transit') !== false || strpos($status_str, 'menuju') !== false) {
        $step = 2;
    }
}

$q_notif = "SELECT * FROM notifikasi ORDER BY waktu_kirim DESC LIMIT 2";
$res_notif = mysqli_query($koneksi, $q_notif);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Hasil Tracking - SIM Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #F66341;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Poppins', sans-serif;
            -webkit-tap-highlight-color: transparent;
            margin: 0;
        }

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .sf-pro {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }


        .step-active {
            border-color: var(--shopee-orange);
            background-color: var(--shopee-orange);
            box-shadow: 0 0 0 4px rgba(246, 99, 65, 0.2);
        }

        .step-inactive {
            border-color: #e2e8f0;
            background-color: white;
        }

        .line-active {
            background-color: var(--shopee-orange);
        }

        .line-inactive {
            background-color: #e2e8f0;
        }

        .text-active {
            color: #1e293b;
        }

        .text-inactive {
            color: #94a3b8;
        }
    </style>
</head>

<body class="flex justify-center min-h-screen">
    <div class="w-full max-w-[400px] bg-white h-screen relative shadow-2xl flex flex-col border-x border-gray-100 overflow-hidden">

        <div class="shopee-bg w-full shrink-0 relative z-20 text-white shadow-md">
            <div class="w-full h-[40px] px-6 flex justify-between items-center">
                <span class="sf-pro font-semibold text-[15px]">9:41</span>
                <div class="w-6 h-3 border border-white/80 rounded-sm relative">
                    <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                </div>
            </div>
            <div class="px-5 py-4 flex items-center gap-3">
                <a href="portalpelanggan.php" class="p-2 bg-white/20 rounded-full active:opacity-50 transition-opacity">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </a>
                <h1 class="text-[18px] font-bold tracking-wide">Status Pengiriman</h1>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar pb-10 bg-gray-50">

            <?php if ($paket): ?>

                <div class="bg-white p-6 shadow-sm border-b border-gray-100 mb-2">
                    <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest mb-1.5">No. Resi</p>
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-gray-900 font-extrabold text-[20px] tracking-wider uppercase"><?= htmlspecialchars($paket['resi']) ?></h2>
                        <span class="bg-orange-100 text-[#F66341] px-3 py-1 rounded-md text-[11px] font-bold uppercase"><?= htmlspecialchars($paket['status']) ?></span>
                    </div>

                    <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 mt-0.5 text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Alamat Tujuan</p>
                            <p class="text-gray-800 text-[13px] font-semibold leading-relaxed"><?= htmlspecialchars($paket['alamat']) ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 shadow-sm border-y border-gray-100">
                    <h3 class="text-gray-900 font-bold text-[16px] mb-6">Riwayat Perjalanan</h3>

                    <div class="relative ml-3">

                        <div class="absolute left-[11px] top-4 bottom-8 w-1 <?= $step >= 4 ? 'line-active' : 'line-inactive' ?> rounded-full z-0"></div>

                        <div class="flex gap-5 mb-8 relative z-10">
                            <div class="w-6 h-6 rounded-full border-[5px] <?= $step >= 4 ? 'step-active' : 'step-inactive' ?> mt-1 shrink-0 bg-white"></div>
                            <div>
                                <h4 class="font-bold text-[15px] <?= $step >= 4 ? 'text-active' : 'text-inactive' ?>">Paket Diterima</h4>
                                <p class="text-[12px] font-medium text-gray-500 mt-1 <?= $step >= 4 ? 'block' : 'hidden' ?>">Paket telah berhasil diserahkan ke alamat tujuan. Terima kasih telah menggunakan layanan kami!</p>
                            </div>
                        </div>

                        <div class="flex gap-5 mb-8 relative z-10">
                            <div class="w-6 h-6 rounded-full border-[5px] <?= $step >= 3 ? 'step-active' : 'step-inactive' ?> mt-1 shrink-0 bg-white"></div>
                            <div>
                                <h4 class="font-bold text-[15px] <?= $step >= 3 ? 'text-active' : 'text-inactive' ?>">Sedang Dikirim</h4>
                                <p class="text-[12px] font-medium text-gray-500 mt-1 <?= $step >= 3 ? 'block' : 'hidden' ?>">Kurir Last Mile sedang membawa paket menuju ke lokasi Anda. Harap bersiap.</p>
                            </div>
                        </div>


                        <div class="flex gap-5 mb-8 relative z-10">
                            <div class="w-6 h-6 rounded-full border-[5px] <?= $step >= 2 ? 'step-active' : 'step-inactive' ?> mt-1 shrink-0 bg-white"></div>
                            <div>
                                <h4 class="font-bold text-[15px] <?= $step >= 2 ? 'text-active' : 'text-inactive' ?>">Tiba di Hub / Transit</h4>
                                <p class="text-[12px] font-medium text-gray-500 mt-1 <?= $step >= 2 ? 'block' : 'hidden' ?>">Paket sedang diproses di pusat penyortiran dan segera diteruskan.</p>
                            </div>
                        </div>


                        <div class="flex gap-5 relative z-10">
                            <div class="w-6 h-6 rounded-full border-[5px] step-active mt-1 shrink-0 bg-white"></div>
                            <div>
                                <h4 class="font-bold text-[15px] text-active">Paket Diproses</h4>
                                <p class="text-[12px] font-medium text-gray-500 mt-1">Pengirim telah menyerahkan paket ke pihak logistik.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($res_notif && mysqli_num_rows($res_notif) > 0): ?>
                    <div class="bg-white p-6 mt-2 shadow-sm border-y border-gray-100">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-[#F66341]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <h3 class="text-gray-900 font-bold text-[14px]">Informasi Layanan</h3>
                        </div>
                        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 space-y-3">
                            <?php while ($notif = mysqli_fetch_assoc($res_notif)): ?>
                                <div class="flex items-start gap-2">
                                    <div class="w-1.5 h-1.5 bg-[#F66341] rounded-full mt-2 shrink-0"></div>
                                    <p class="text-gray-700 text-[12px] font-medium leading-relaxed"><?= htmlspecialchars($notif['pesan']) ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php else: ?>

                <div class="flex-1 flex flex-col items-center justify-center p-8 text-center mt-20">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                    </div>
                    <h2 class="text-gray-800 font-bold text-[20px] mb-2">Resi Tidak Ditemukan</h2>
                    <p class="text-gray-500 text-[14px] font-medium mb-8">Pastikan nomor resi <b><?= htmlspecialchars($resi) ?></b> sudah diketik dengan benar dan coba lagi.</p>
                    <a href="portalpelanggan.php" class="bg-gray-900 text-white px-8 py-3.5 rounded-xl font-bold text-[14px] active:scale-95 transition-all">Cari Resi Lain</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</body>

</html>
