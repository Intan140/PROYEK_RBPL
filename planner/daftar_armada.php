<?php
include '../sim_logistik/koneksi.php';

$query = "
    SELECT 
        j.*, 
        d.nama_driver AS nama_supir, 
        h1.nama_hub AS kota_asal, 
        h2.nama_hub AS kota_tujuan 
    FROM jadwal_armada j
    LEFT JOIN driver d ON j.id_driver = d.id_driver
    LEFT JOIN rute r ON j.id_rute = r.id_rute
    LEFT JOIN hub h1 ON r.asal_hub = h1.id_hub
    LEFT JOIN hub h2 ON r.tujuan_hub = h2.id_hub
    ORDER BY j.tanggal_berangkat ASC
";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$total_jadwal = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Daftar Armada - Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #F66341;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
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
            transition: transform 0.2s ease;
        }

        .glass-card:active {
            transform: scale(0.98);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#fdfdfd] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full h-[120px] absolute top-0 left-0 z-0"></div>

        <div class="relative z-10 w-full h-[40px] px-6 flex justify-between items-center mt-1">
            <span class="text-white text-[16px] font-semibold">9:41</span>
            <div class="flex items-center gap-2">
                <svg width="17" height="11" viewBox="0 0 17 11" fill="none">
                    <path d="M1 5C3.5 2 7.5 2 10 5M1 8C2.5 6.5 4.5 6.5 6 8" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
                <div class="w-6 h-3 border-2 border-white/40 rounded-[3px] relative">
                    <div class="absolute inset-[1px] bg-white w-[70%] rounded-[1px]"></div>
                </div>
            </div>
        </div>

        <div class="relative z-10 px-6 mt-4 flex items-center gap-4">

            <a href="obplanner.php" class="flex items-center justify-center active:scale-90 transition w-8 h-8">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <div class="flex flex-1 items-center justify-between">
                <h1 class="text-white text-[20px] font-bold font-poppins tracking-wide">Jadwal Armada</h1>
                <span class="bg-white/20 text-white text-[10px] font-bold px-3 py-1.5 rounded-full backdrop-blur-sm"><?= $total_jadwal ?> Rute</span>
            </div>
        </div>

        <div class="relative z-10 px-6 mt-10 flex-1 overflow-y-auto no-scrollbar pb-32">
            <div class="space-y-4">
                <?php
                if ($total_jadwal > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $date = new DateTime($row['tanggal_berangkat']);
                        $tgl = $date->format('d M Y');
                        $jam = $date->format('H:i');

                        $status_class = "bg-blue-50 text-blue-600";
                        if (strtolower($row['status_perjalanan']) == 'selesai') $status_class = "bg-green-50 text-green-600";
                        if (strtolower($row['status_perjalanan']) == 'tertunda') $status_class = "bg-red-50 text-red-600";
                ?>
                        <div class="glass-card rounded-[20px] p-5 border-l-4 border-[#F66341]">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 shopee-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 font-bold font-poppins text-[15px]"><?= htmlspecialchars($row['nama_supir'] ?: 'Supir Tidak Terdaftar') ?></h3>
                                        <p class="text-gray-500 text-[12px] font-medium tracking-wide">JADWAL #<?= htmlspecialchars($row['id_jadwal']) ?></p>
                                    </div>
                                </div>
                                <span class="status-badge <?= $status_class ?> text-right shrink-0 mt-1"><?= htmlspecialchars($row['status_perjalanan']) ?></span>
                            </div>

                            <div class="h-[1px] w-full bg-gray-100 mb-4"></div>

                            <div class="mb-4">
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    <div>
                                        <p class="text-[11px] font-bold text-gray-400 uppercase">Detail Rute</p>
                                        <p class="text-gray-800 text-[13px] font-semibold leading-relaxed">
                                            <?= htmlspecialchars($row['kota_asal']) ?> <span class="text-orange-500 mx-1">➔</span> <?= htmlspecialchars($row['kota_tujuan']) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-3 flex items-center justify-between border border-gray-100">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-[13px] font-semibold"><?= $tgl ?></span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-[13px] font-semibold"><?= $jam ?> WIB</span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="flex flex-col items-center justify-center mt-16 opacity-50">
                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        <p class="font-montserrat text-sm text-center font-medium">Belum ada jadwal armada.</p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] h-[85px] bg-white shadow-[0_-10px_40px_rgba(0,0,0,0.06)] rounded-t-[32px] flex justify-around items-center z-50 border-t border-gray-50">
            <button class="flex flex-col items-center gap-1.5 px-4 transition-all active:scale-95 text-[#F66341]">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="text-[10px] font-bold font-jakarta tracking-wider uppercase">Daftar Armada</span>
            </button>
            <div class="relative">
                <a href="tambah_rute.php" class="shopee-bg w-[58px] h-[54px] -mt-12 rounded-[20px] flex items-center justify-center shadow-2xl shadow-orange-300 border-[4px] border-white">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </a>
            </div>
            <a href="tambah_rute.php" class="flex flex-col items-center gap-1.5 px-4 opacity-30 transition-all active:scale-95 no-underline">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-[10px] font-bold text-gray-800 font-jakarta tracking-wider uppercase">Tambah</span>
            </a>
        </div>
    </div>
</body>

</html>