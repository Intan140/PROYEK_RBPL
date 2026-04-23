<?php
include '..koneksi.php';

$q_tiba = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pesanan WHERE status = 'Tiba di Hub Tujuan'");
$tot_tiba = mysqli_fetch_assoc($q_tiba)['total'];

$q_kirim = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pesanan WHERE status = 'Out for Delivery'");
$tot_kirim = mysqli_fetch_assoc($q_kirim)['total'];

$q_kurir = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM driver WHERE status = 'Aktif'");
$tot_kurir = mysqli_fetch_assoc($q_kurir)['total'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Dashboard - Operator Last Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #ee4d2d;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .shopee-text {
            color: var(--shopee-orange);
        }

        .glass-card {
            background: white;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.04);
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.02);
            transition: transform 0.2s;
        }

        .glass-card:active {
            transform: scale(0.97);
        }

        .nav-shadow {
            box-shadow: 0px -4px 20px rgba(0, 0, 0, 0.05);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 600;
        }

        .nav-item.active {
            color: var(--shopee-orange);
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#f8fafc] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full shrink-0 rounded-b-3xl shadow-md pb-6 relative z-10">
            <div class="px-5 pt-3 flex justify-between items-center text-white text-[13px] font-bold tracking-wide">
                <span>9:41</span>
                <div class="flex items-center gap-1.5">
                    <div class="w-6 h-3 border-2 border-white/60 rounded-sm relative">
                        <div class="absolute inset-[1px] bg-white w-[75%] rounded-[1px]"></div>
                    </div>
                </div>
            </div>
            <div class="px-6 pt-6 flex items-center gap-4">

                <a href="oboperator.php" class="flex items-center justify-center active:scale-90 transition">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                </a>
                <div class="flex-1">
                    <p class="text-white/80 text-xs font-semibold uppercase tracking-wider mb-0.5">Hub Tujuan Akhir</p>
                    <h1 class="text-white text-2xl font-extrabold tracking-tight">Operator Center</h1>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar px-6 pt-6 pb-28 -mt-4">

            <h2 class="text-gray-800 text-lg font-bold mb-4">Ringkasan Last Mile</h2>

            <div class="grid grid-cols-2 gap-4 mb-6">

                <div class="glass-card p-5 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-orange-100 rounded-full opacity-50"></div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Belum Sortir</p>
                    <h3 class="text-gray-800 text-3xl font-extrabold"><?= $tot_tiba ?></h3>
                    <p class="text-orange-500 text-[11px] font-semibold mt-2">Menunggu diproses</p>
                </div>

                <div class="glass-card p-5 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-blue-100 rounded-full opacity-50"></div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Out for Delivery</p>
                    <h3 class="text-gray-800 text-3xl font-extrabold"><?= $tot_kirim ?></h3>
                    <p class="text-blue-500 text-[11px] font-semibold mt-2">Dibawa Kurir Lokal</p>
                </div>
            </div>

            <h2 class="text-gray-800 text-lg font-bold mb-4">Tindakan Operasional</h2>

            <div class="space-y-3">
                <a href="scan_paket.php" class="glass-card p-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center shopee-text">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-gray-800 font-bold text-[15px]">1. Scan Kedatangan</h4>
                            <p class="text-gray-400 text-xs font-medium mt-0.5">Scan resi dari Middle Mile</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <a href="sortir.php" class="glass-card p-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-gray-800 font-bold text-[15px]">2. Sortir & Penugasan</h4>
                            <p class="text-gray-400 text-xs font-medium mt-0.5">Atur rute & pilih kurir lokal</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

        </div>

        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white border-t border-gray-100 h-16 flex justify-around items-center px-2 z-[100] nav-shadow">
            <a href="dashboard.php" class="nav-item active">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px]">Home</span>
            </a>
            <a href="scan_paket.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                </svg>
                <span class="text-[10px]">Scan</span>
            </a>
            <a href="sortir.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="text-[10px]">Sortir</span>
            </a>
        </nav>
    </div>
</body>

</html>
