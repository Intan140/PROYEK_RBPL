<?php
include '../koneksi.php';

$is_detail_mode = isset($_GET['id']) && !empty($_GET['id']);
$order_data = null;

if ($is_detail_mode) {
    $id_pesanan = mysqli_real_escape_string($koneksi, $_GET['id']);
    $q_detail = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_pesanan = '$id_pesanan'");
    $order_data = mysqli_fetch_assoc($q_detail);
} else {

    $q_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pesanan");
    $total_packages = mysqli_fetch_assoc($q_total)['total'];

    $q_weight = mysqli_query($koneksi, "SELECT SUM(berat) as total_weight FROM pesanan");
    $total_weight = mysqli_fetch_assoc($q_weight)['total_weight'];
    if (!$total_weight) $total_weight = 0;

    $q_routes = "
        SELECT j.*, d.nama_driver, r.asal_hub, r.tujuan_hub 
        FROM jadwal_armada j
        LEFT JOIN driver d ON j.id_driver = d.id_driver
        LEFT JOIN rute r ON j.id_rute = r.id_rute
        ORDER BY j.tanggal_berangkat DESC 
        LIMIT 5
    ";
    $result_routes = mysqli_query($koneksi, $q_routes);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= $is_detail_mode ? 'Detail Pesanan' : 'Statistics' ?> - Middle Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .shopee-text {
            color: var(--shopee-orange);
        }

        .glass-card {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
        }

        .stat-icon-box {
            width: 40px;
            height: 40px;
            background: var(--shopee-orange);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            color: #64748b;
            font-size: 11px;
            font-weight: 500;
            text-decoration: none;
            flex: 1;
        }

        .nav-item.active {
            color: var(--shopee-orange);
        }

        .timeline-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #cbd5e1;
            position: relative;
            z-index: 10;
        }

        .timeline-dot.active {
            background-color: var(--shopee-orange);
            box-shadow: 0 0 0 4px rgba(246, 99, 65, 0.2);
        }

        .timeline-line {
            position: absolute;
            left: 4px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #f1f5f9;
            z-index: 1;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">

    <div class="w-full max-w-[400px] bg-[#fdfdfd] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full h-[107px] absolute top-0 left-0 z-0"></div>

        <div class="relative z-10 w-full h-[40px] px-6 flex justify-between items-center mt-1">
            <span class="text-white text-[16px] font-semibold font-poppins">9:41</span>
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

            <a href="<?= $is_detail_mode ? 'trackingstatus.php' : 'obadmin.php' ?>" class="flex items-center justify-center active:scale-90 transition w-8 h-8">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <h1 class="text-white text-[20px] font-bold font-montserrat tracking-tight">
                <?= $is_detail_mode ? 'Informasi Paket' : 'Statistics' ?>
            </h1>
        </div>

        <div class="relative z-10 flex-1 overflow-y-auto no-scrollbar pt-10 pb-24 px-6">

            <?php if ($is_detail_mode && $order_data): ?>

                <div class="glass-card p-6 mb-8">
                    <div class="flex flex-col gap-1 mb-6">
                        <span class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Resi Pengiriman</span>
                        <h2 class="text-[#030303] text-[20px] font-bold font-montserrat"><?= htmlspecialchars($order_data['resi']) ?></h2>
                        <div class="inline-flex mt-1">
                            <span class="shopee-bg text-white text-[9px] font-bold px-2 py-0.5 rounded uppercase"><?= htmlspecialchars($order_data['status']) ?></span>
                        </div>
                    </div>

                    <div class="space-y-5 border-t border-gray-50 pt-5">
                        <div class="flex flex-col">
                            <span class="text-gray-400 text-[11px] font-semibold uppercase">Produk</span>
                            <span class="text-[#030303] text-[14px] font-bold"><?= htmlspecialchars($order_data['nama_produk']) ?> (<?= htmlspecialchars($order_data['jumlah']) ?> pcs)</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-gray-400 text-[11px] font-semibold uppercase">Berat Paket</span>
                            <span class="text-[#030303] text-[14px] font-bold"><?= htmlspecialchars($order_data['berat']) ?> kg</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-gray-400 text-[11px] font-semibold uppercase">Alamat Tujuan</span>
                            <p class="text-[#030303] text-[13px] font-medium leading-relaxed bg-gray-50 p-3 rounded-xl border border-dashed border-gray-200 mt-1">
                                <?= htmlspecialchars($order_data['alamat']) ?>
                            </p>
                        </div>
                    </div>
                </div>


                <div class="space-y-6 pl-2">
                    <h3 class="text-[#080A0B] text-[14px] font-bold uppercase tracking-wide">Status Perjalanan</h3>
                    <div class="relative">
                        <div class="timeline-line"></div>

                        <div class="relative flex gap-5 mb-8">
                            <div class="timeline-dot active"></div>
                            <div class="-mt-1">
                                <p class="text-[13px] font-bold text-[#030303]"><?= htmlspecialchars($order_data['status']) ?></p>
                                <p class="text-[11px] text-gray-400">Diproses oleh Middle Mile Admin</p>
                            </div>
                        </div>

                        <div class="relative flex gap-5">
                            <div class="timeline-dot"></div>
                            <div class="-mt-1">
                                <p class="text-[13px] font-medium text-gray-400">Order Created</p>
                                <p class="text-[11px] text-gray-300 italic">Pesanan masuk ke sistem logistik</p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php elseif ($is_detail_mode && !$order_data): ?>
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="font-bold text-sm text-gray-400">Data pesanan tidak ditemukan.</p>
                </div>

            <?php else: ?>

                <div class="flex justify-between items-start mb-10">
                    <div class="flex flex-col items-center w-1/3 text-center">
                        <div class="stat-icon-box mb-2">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M21 8l-9-4-9 4m18 0l-9 4m9-4v10l-9 4m0-10L3 8m9 4v10M3 8v10l9 4" />
                            </svg>
                        </div>
                        <span class="text-[#080A0B] text-[18px] font-bold"><?= number_format($total_packages) ?></span>
                        <p class="text-[#5D5D5B] text-[10px] leading-tight font-bold uppercase opacity-50">Packages</p>
                    </div>
                    <div class="flex flex-col items-center w-1/3 text-center border-x border-gray-100">
                        <div class="stat-icon-box mb-2">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M12 2v20M5 7l7-5 7 5M5 17l7 5 7-5" />
                            </svg>
                        </div>
                        <span class="text-[#080A0B] text-[18px] font-bold"><?= number_format($total_weight, 1) ?> kg</span>
                        <p class="text-[#5D5D5B] text-[10px] leading-tight font-bold uppercase opacity-50">Total Weight</p>
                    </div>
                    <div class="flex flex-col items-center w-1/3 text-center">
                        <div class="stat-icon-box mb-2">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </div>
                        <span class="text-[#080A0B] text-[18px] font-bold">10h</span>
                        <p class="text-[#5D5D5B] text-[10px] leading-tight font-bold uppercase opacity-50">Avg Time</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-[#080A0B] text-[14px] font-bold uppercase tracking-wider mb-4">Recent Routes</h2>
                    <?php if ($result_routes && mysqli_num_rows($result_routes) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result_routes)): ?>
                            <div class="glass-card p-4">
                                <p class="text-[#030303] text-[13px] font-bold">➔ <?= htmlspecialchars($row['tujuan_hub']) ?></p>
                                <p class="text-gray-400 text-[11px] mt-1 italic"><?= htmlspecialchars($row['nama_driver']) ?> • <?= date('j M, H:i', strtotime($row['tanggal_berangkat'])) ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <button onclick="window.location.href='input.php'" class="w-full mt-4 shopee-bg text-white py-3.5 rounded-xl font-bold text-[13px] shadow-lg active:scale-95 transition-all">
                        INPUT DATA BARU
                    </button>
                </div>
            <?php endif; ?>

        </div>

        <div class="bg-white border-t border-gray-100 w-full h-[75px] flex justify-around items-center px-4 z-20 absolute bottom-0">
            <a href="trackingstatus.php" class="nav-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10H3M21 6H3M21 14H3M21 18H3"></path>
                </svg>
                <span>Tracking</span>
            </a>
            <a href="detail.php" class="nav-item active">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <span>Statistik</span>
            </a>
            <a href="input.php" class="nav-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Input</span>
            </a>
        </div>
    </div>
</body>

</html>