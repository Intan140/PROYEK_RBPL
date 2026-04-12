<?php
include '../sim_logistik/koneksi.php';

$q_driver = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM driver");
$tot_driver = mysqli_fetch_assoc($q_driver)['total'];

$q_paket = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pesanan");
$tot_paket = mysqli_fetch_assoc($q_paket)['total'];

$q_jadwal = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jadwal_armada WHERE status_perjalanan = 'Terjadwal'");
$tot_jadwal = mysqli_fetch_assoc($q_jadwal)['total'];

$q_transit = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pesanan WHERE status LIKE '%Transit%'");
$tot_transit = mysqli_fetch_assoc($q_transit)['total'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Halaman Utama - Admin Middle Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Montserrat:wght@400;700&family=Plus+Jakarta+Sans:wght@700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
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

        .font-montserrat-bold {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 16px;
            color: #030303;
        }

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .shopee-text {
            color: var(--shopee-orange);
        }

        .search-container {
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.08);
            outline: 1px #DFDFDF solid;
        }

        .stat-card {
            background-color: var(--shopee-orange);
            border-radius: 12px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            height: 140px;
            transition: transform 0.2s;
            box-shadow: 0 4px 12px rgba(238, 77, 45, 0.15);
            cursor: pointer;
            text-decoration: none;
            position: relative;
        }

        .stat-card:active {
            transform: scale(0.97);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
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
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .nav-item.active {
            color: var(--shopee-orange);
        }

        .badge-count {
            position: absolute;
            top: 12px;
            right: 12px;
            background: white;
            color: var(--shopee-orange);
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 14px;
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

                    <a href="obkoor.php" class="flex items-center justify-center active:scale-90 transition">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                            <path d="M19 12H5M12 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h1 class="font-app-bar">Halaman Utama Koordinator</h1>
                </div>
            </div>
        </div>

        <div class="px-5 mt-4">
            <div class="search-container bg-white w-full h-[47px] flex items-center px-4 justify-between rounded-lg">
                <span class="font-montserrat-reg text-[#282828] text-sm">Cari data armada...</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#030303" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar px-6 pt-6 pb-28">
            <div class="flex justify-between items-center mb-6 px-2">
                <div class="text-center">
                    <span class="block font-bold shopee-text text-sm">Fleet</span>
                    <span class="text-gray-400 text-[10px] uppercase font-bold tracking-tighter">Overview</span>
                    <div class="w-6 h-[2.5px] shopee-bg mx-auto mt-1 rounded-full"></div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="stat-card">
                    <span class="font-montserrat-bold text-white leading-tight">Total<br>Driver</span>
                    <span class="badge-count"><?= $tot_driver ?></span>
                    <div class="mt-auto self-end opacity-30"><svg width="28" height="28" viewBox="0 0 24 24" fill="white">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg></div>
                </div>

                <a href="trackking.php" class="stat-card">
                    <span class="font-montserrat-bold text-white leading-tight">Total<br>Paket</span>
                    <span class="badge-count"><?= $tot_paket ?></span>
                    <div class="mt-auto self-end opacity-30"><svg width="28" height="28" viewBox="0 0 24 24" fill="white">
                            <path d="M21 10H3M21 6H3M21 14H3M21 18H3" />
                        </svg></div>
                </a>

                <a href="distribusi.php" class="stat-card">
                    <span class="font-montserrat-bold text-white leading-tight">Jadwal<br>Truk</span>
                    <span class="badge-count"><?= $tot_jadwal ?></span>
                    <div class="mt-auto self-end opacity-30"><svg width="28" height="28" viewBox="0 0 24 24" fill="white">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg></div>
                </a>

                <a href="trackking.php" class="stat-card">
                    <span class="font-montserrat-bold text-white leading-tight">In-Transit<br>Updates</span>
                    <span class="badge-count"><?= $tot_transit ?></span>
                    <div class="mt-auto self-end opacity-30"><svg width="28" height="28" viewBox="0 0 24 24" fill="white">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                        </svg></div>
                </a>

                <a href="distribusi.php" class="stat-card col-span-2 relative overflow-hidden flex-row justify-between items-center h-[90px]">
                    <div class="flex flex-col">
                        <span class="font-montserrat-bold text-white text-lg">Distribusi & Rute</span>
                        <span class="text-white/70 text-[10px] font-bold uppercase tracking-wider">Monitoring Perjalanan</span>
                    </div>
                    <div class="w-[50px] h-[50px] bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <div class="w-[18px] h-[18px] border-2 border-white rounded-sm"></div>
                    </div>
                </a>

                <a href="inspeksikendaraan.php" class="stat-card col-span-2 relative overflow-hidden flex-row justify-between items-center h-[90px] bg-gray-800">
                    <div class="flex flex-col">
                        <span class="font-montserrat-bold text-white text-lg">Audit Regional</span>
                        <span class="text-white/70 text-[10px] font-bold uppercase tracking-wider">Inspeksi Kendaraan</span>
                    </div>
                    <div class="w-[50px] h-[50px] bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white border-t border-gray-100 h-16 flex justify-around items-center px-2 z-[100] nav-shadow">
            <a href="dashboard.php" class="nav-item active">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px] font-medium">Beranda</span>
            </a>
            <a href="tracking.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                <span class="text-[10px] font-medium">Lacak</span>
            </a>
            <a href="perubahan.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="text-[10px] font-medium">Notifikasi</span>
            </a>
            <a href="#" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[10px] font-medium">Saya</span>
            </a>
        </nav>
    </div>
</body>

</html>