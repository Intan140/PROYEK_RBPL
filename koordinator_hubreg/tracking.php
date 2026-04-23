<?php
include '../koneksi.php';

$query_paket = "SELECT * FROM pesanan ORDER BY id_pesanan DESC LIMIT 20";
$result_paket = mysqli_query($koneksi, $query_paket);

$q_in_transit = mysqli_query($koneksi, "SELECT COUNT(*) as transit FROM pesanan WHERE status LIKE '%Transit%'");
$in_transit = mysqli_fetch_assoc($q_in_transit)['transit'];

$q_driver_aktif = mysqli_query($koneksi, "SELECT COUNT(*) as driver_aktif FROM driver WHERE status = 'Aktif'");
$driver_aktif = $q_driver_aktif ? mysqli_fetch_assoc($q_driver_aktif)['driver_aktif'] : 'N/A';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Tracking - Admin Middle Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
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

        .font-status-bar {
            font-size: 12px;
            font-weight: 600;
            color: white;
        }

        .font-app-bar {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 18px;
            color: white;
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

        .stat-card {
            background: white;
            box-shadow: 2px 0px 10px rgba(3, 3, 3, 0.10);
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .package-card {
            background: white;
            box-shadow: 2px 0px 10px rgba(3, 3, 3, 0.10);
            border: 1px solid rgba(0, 0, 0, 0.10);
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .package-card:active {
            transform: scale(0.98);
        }

        .nav-shadow {
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.05);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
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
            <div class="px-5 pt-2 flex justify-between items-center font-status-bar">
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h1 class="font-app-bar">Tracking Middle Mile</h1>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar pb-24">

            <div class="px-6 pt-6 space-y-4">
                <div class="stat-card p-4 flex justify-between items-center">
                    <span class="font-montserrat font-bold text-[15px] text-gray-700">Packages in Transit</span>
                    <span class="font-montserrat font-bold text-[20px] shopee-text"><?= $in_transit ?></span>
                </div>
                <div class="stat-card p-4 flex justify-between items-center">
                    <span class="font-montserrat font-bold text-[15px] text-gray-700">Active Drivers</span>
                    <span class="font-montserrat font-bold text-[20px] text-blue-600"><?= $driver_aktif ?></span>
                </div>
            </div>

            <div class="px-6 mt-8 mb-4 flex justify-between items-end">
                <h3 class="font-montserrat text-[18px] font-bold text-gray-800">Daftar Paket</h3>
            </div>

            <div class="px-6 space-y-4">
                <?php
                if (mysqli_num_rows($result_paket) > 0) {
                    while ($row = mysqli_fetch_assoc($result_paket)) {
                        $status_str = strtolower($row['status']);
                        $status_color = "text-orange-400";

                        if (strpos($status_str, 'transit') !== false) {
                            $status_color = "text-blue-500";
                        } elseif (strpos($status_str, 'delivered') !== false || strpos($status_str, 'selesai') !== false) {
                            $status_color = "text-green-500";
                        }
                ?>
                        <div class="package-card p-4 flex justify-between items-center">
                            <div class="w-2/3">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">No. Resi</span>
                                <h4 class="font-montserrat text-[15px] font-bold truncate text-gray-800"><?= htmlspecialchars($row['resi']) ?></h4>
                                <p class="font-montserrat text-[13px] text-gray-600 mt-1">Status: <span class="<?= $status_color ?> font-bold"><?= htmlspecialchars($row['status'] ? $row['status'] : 'Pending') ?></span></p>
                            </div>
                            <button class="shopee-bg text-white px-3 py-2 font-montserrat font-bold text-[12px] rounded-md shadow-sm active:opacity-80">
                                View Detail
                            </button>
                        </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center text-gray-400 text-sm mt-8'>Belum ada data paket untuk dilacak.</p>";
                }
                ?>
            </div>
        </div>

        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white border-t border-gray-100 h-16 flex justify-around items-center px-2 z-[100] nav-shadow">
            <a href="dashboard.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px]">Beranda</span>
            </a>
            <a href="trackking.php" class="nav-item active">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                <span class="text-[10px]">Lacak</span>
            </a>
            <a href="perubahan.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="text-[10px]">Notifikasi</span>
            </a>
            <a href="#" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[10px]">Saya</span>
            </a>
        </nav>
    </div>
</body>

</html>