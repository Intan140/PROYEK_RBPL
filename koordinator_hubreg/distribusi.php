<?php
include '../sim_logistik/koneksi.php';

$query = "
    SELECT j.*, d.nama_driver, r.asal_hub, r.tujuan_hub 
    FROM jadwal_armada j
    LEFT JOIN driver d ON j.id_driver = d.id_driver
    LEFT JOIN rute r ON j.id_rute = r.id_rute
    WHERE j.status_perjalanan != 'Selesai'
    ORDER BY j.tanggal_berangkat ASC
";
$result = mysqli_query($koneksi, $query);
$total_truk = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Truck Schedule - Admin Middle Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;700&family=Plus+Jakarta+Sans:wght@700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
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

        .glass-card {
            background: white;
            box-shadow: 0px 2px 10px rgba(3, 3, 3, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.05);
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
            text-decoration: none;
        }

        .nav-item.active {
            color: var(--shopee-orange);
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
                    <h1 class="font-app-bar">Monitoring Distribusi</h1>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar px-6 pt-6 pb-28">

            <div class="mb-6">
                <div class="w-full h-[232px] glass-card overflow-hidden relative">
                    <img class="w-full h-full object-cover" src="https://placehold.co/350x232/e2e8f0/475569?text=Live+Map+Tracking" />
                    <div class="absolute top-4 left-4 bg-white/90 px-3 py-1 rounded-full text-[10px] font-bold shopee-text shadow-sm border border-orange-100 flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> <?= $total_truk ?> Trucks Online
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h2 class="font-montserrat-bold mb-3 text-[18px]">Upcoming Trips</h2>
                <div class="space-y-4">

                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tgl = date('g:i A, M jS', strtotime($row['tanggal_berangkat']));
                    ?>
                            <div class="glass-card p-4 flex flex-col gap-1 relative overflow-hidden">
                                <div class="absolute top-0 left-0 h-full w-1.5 shopee-bg"></div>
                                <span class="font-montserrat-reg text-[14px]">Rute: <span class="font-bold"><?= htmlspecialchars($row['asal_hub']) ?> ➔ <?= htmlspecialchars($row['tujuan_hub']) ?></span></span>
                                <span class="font-montserrat-reg text-[13px] text-gray-500">Driver: <?= htmlspecialchars($row['nama_driver']) ?></span>
                                <div class="flex items-center justify-between mt-1">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-[#ee4d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" />
                                        </svg>
                                        <span class="font-montserrat-reg font-bold text-[12px] text-[#ee4d2d]"><?= $tgl ?></span>
                                    </div>
                                    <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded uppercase"><?= htmlspecialchars($row['status_perjalanan']) ?></span>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p class='text-gray-400 text-sm italic text-center py-4'>Semua jadwal telah diselesaikan.</p>";
                    }
                    ?>
                </div>
            </div>

            <button onclick="window.location.href='tambah_rute.php'" class="w-full shopee-bg text-white h-[50px] rounded-lg font-montserrat-bold text-[14px] flex items-center justify-center gap-2 mt-6 shadow-lg shadow-orange-200">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                TAMBAH JADWAL TRUK
            </button>
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