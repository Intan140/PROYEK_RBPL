<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id_jadwal = mysqli_real_escape_string($koneksi, $_POST['id_jadwal']);
    $status_baru = mysqli_real_escape_string($koneksi, $_POST['status_baru']);

    $q_update = "UPDATE jadwal_armada SET status_perjalanan = '$status_baru' WHERE id_jadwal = '$id_jadwal'";

    if (mysqli_query($koneksi, $q_update)) {
        echo "<script>alert('Status operasional diperbarui: $status_baru'); window.location.href='driver.php';</script>";
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan sistem: " . mysqli_error($koneksi) . "');</script>";
    }
}

$query = "
    SELECT 
        j.*, 
        d.nama_driver,
        h1.nama_hub AS kota_asal, 
        h2.nama_hub AS kota_tujuan 
    FROM jadwal_armada j
    LEFT JOIN driver d ON j.id_driver = d.id_driver
    LEFT JOIN rute r ON j.id_rute = r.id_rute
    LEFT JOIN hub h1 ON r.asal_hub = h1.id_hub
    LEFT JOIN hub h2 ON r.tujuan_hub = h2.id_hub
    WHERE j.status_perjalanan != 'Tiba di Operator Last Mile'
    ORDER BY j.tanggal_berangkat ASC
";
$result = mysqli_query($koneksi, $query);
$total_tugas = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Monitoring Operasional - SIM Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-theme: #ee4d2d;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        .theme-bg {
            background-color: var(--primary-theme);
        }

        .glass-card {
            background: white;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            border: 1px solid #f1f5f9;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="flex justify-center min-h-screen">
    <div class="w-full max-w-[400px] bg-[#f8fafc] h-screen relative shadow-2xl flex flex-col border-x border-gray-100">

        <div class="theme-bg w-full shrink-0 rounded-b-[32px] shadow-lg pb-8 relative z-10">
            <div class="px-6 pt-4 flex justify-between items-center text-white/80 text-[12px] font-medium">
                <span>Sistem Logistik Terpadu</span>
                <div class="flex items-center gap-1">
                    <div class="w-4 h-2 border border-white/40 rounded-sm relative">
                        <div class="absolute inset-[1px] bg-white w-[80%]"></div>
                    </div>
                </div>
            </div>

            <div class="px-6 pt-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="../onboarding.php" class="bg-white/15 hover:bg-white/25 p-2.5 rounded-xl backdrop-blur-md transition-all border border-white/10">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div>
                        <p class="text-white/60 text-[10px] font-bold uppercase tracking-[0.1em] mb-0.5">Middle Mile Control</p>
                        <h1 class="text-white text-[19px] font-extrabold tracking-tight">Monitoring Armada</h1>
                    </div>
                </div>
                <div class="w-12 h-12 bg-white/15 rounded-2xl flex items-center justify-center border border-white/10 shadow-inner text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar px-6 pt-8 pb-24">
            <div class="flex justify-between items-end mb-6">
                <div>
                    <h2 class="text-gray-900 text-[17px] font-bold">Jadwal Aktif</h2>
                    <p class="text-gray-400 text-xs mt-0.5">Daftar rute dalam pantauan</p>
                </div>
                <span class="text-[11px] bg-gray-900 text-white px-3 py-1.5 rounded-lg font-bold uppercase tracking-wider">
                    <?= $total_tugas ?> Unit
                </span>
            </div>

            <div class="space-y-6">
                <?php
                if ($total_tugas > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tgl = date('d M Y', strtotime($row['tanggal_berangkat']));
                        $jam = date('H:i', strtotime($row['tanggal_berangkat']));
                        $status = $row['status_perjalanan'];
                ?>
                        <div class="glass-card p-5 relative">

                            <div class="absolute top-4 right-4 flex items-center gap-1.5">
                                <div class="w-2 h-2 rounded-full <?= ($status == 'Terjadwal' || $status == 'Pending') ? 'bg-amber-400' : 'bg-green-500 animate-pulse' ?>"></div>
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-tight">
                                    <?= htmlspecialchars($status ?: 'Proses') ?>
                                </span>
                            </div>

                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest">Operator / Driver</p>
                                    <p class="text-slate-900 font-bold text-[14px] leading-tight"><?= htmlspecialchars($row['nama_driver'] ?? 'Belum Ditugaskan') ?></p>
                                </div>
                            </div>

                            <div class="relative space-y-6 mb-6">
                                <div class="absolute left-[19px] top-4 bottom-4 w-px bg-slate-100 border-l border-dashed border-slate-300"></div>

                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="w-10 h-10 bg-white border-2 border-slate-100 rounded-xl flex items-center justify-center shadow-sm">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest">Origin</p>
                                        <h3 class="text-slate-800 font-bold text-[14px]"><?= htmlspecialchars($row['kota_asal'] ?? 'N/A') ?></h3>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="w-10 h-10 bg-slate-900 border-2 border-slate-900 rounded-xl flex items-center justify-center shadow-md">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest">Destination</p>
                                        <h3 class="text-slate-800 font-bold text-[14px]"><?= htmlspecialchars($row['kota_tujuan'] ?? 'N/A') ?></h3>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 bg-slate-50 rounded-xl p-4 mb-6 border border-slate-100">
                                <div>
                                    <span class="text-slate-400 text-[9px] font-bold uppercase block mb-1">Estimasi Berangkat</span>
                                    <span class="text-slate-700 font-bold text-[13px]"><?= $tgl ?></span>
                                </div>
                                <div class="text-right border-l border-slate-200 pl-4">
                                    <span class="text-slate-400 text-[9px] font-bold uppercase block mb-1">Jam Operasional</span>
                                    <span class="text-slate-700 font-bold text-[13px]"><?= $jam ?> WIB</span>
                                </div>
                            </div>

                            <form method="POST" action="">
                                <input type="hidden" name="id_jadwal" value="<?= $row['id_jadwal'] ?>">
                                <?php if ($status == 'Terjadwal' || $status == 'Pending' || $status == ''): ?>
                                    <input type="hidden" name="status_baru" value="Dalam Perjalanan">
                                    <button type="submit" name="update_status" class="w-full bg-slate-900 hover:bg-black text-white h-[52px] rounded-xl flex items-center justify-center gap-3 font-bold text-[12px] transition-all active:scale-[0.98] uppercase tracking-wider shadow-lg">
                                        Konfirmasi Keberangkatan
                                    </button>
                                <?php elseif ($status == 'Dalam Perjalanan'): ?>

                                    <input type="hidden" name="status_baru" value="Tiba di Operator Last Mile">
                                    <button type="submit" name="update_status" class="w-full theme-bg hover:opacity-90 text-white h-[52px] rounded-xl flex items-center justify-center gap-3 font-bold text-[12px] transition-all active:scale-[0.98] uppercase tracking-wider shadow-lg">
                                        Konfirmasi Tiba di Last Mile
                                    </button>
                                <?php endif; ?>
                            </form>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center text-slate-300 mb-5">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-slate-900 font-bold text-lg">Operasional Nihil</h3>
                        <p class="text-slate-400 text-sm mt-2 px-10 leading-relaxed">Saat ini tidak ada tugas perjalanan aktif yang perlu dipantau.</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 w-32 h-1.5 bg-slate-200 rounded-full opacity-50"></div>
    </div>
</body>

</html>
