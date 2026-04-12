<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Daftar Pengantaran - Last Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #F66341;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            -webkit-tap-highlight-color: transparent;
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .glass-card:active {
            transform: scale(0.98);
        }

        .status-bar-text {
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            font-weight: 700;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">

    <div class="w-full max-w-[400px] bg-[#fdfdfd] min-h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full h-[120px] absolute top-0 left-0 z-0"></div>

        <div class="relative z-10 w-full h-[40px] px-6 flex justify-between items-center">
            <span class="status-bar-text text-white text-[15px]">9:41</span>
            <div class="flex items-center gap-2">
                <svg width="17" height="11" viewBox="0 0 17 11" fill="none">
                    <path d="M1 5C3.5 2 7.5 2 10 5M1 8C2.5 6.5 4.5 6.5 6 8" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
                <div class="w-6 h-3 border-2 border-white/40 rounded-[3px] relative">
                    <div class="absolute inset-[1px] bg-white w-[70%] rounded-[1px]"></div>
                </div>
            </div>
        </div>

        <div class="relative z-10 px-6 mt-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <button onclick="window.history.back()" class="p-1 active:scale-90 transition-transform -ml-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>
                <h1 class="text-white text-[22px] font-bold font-jakarta">Logistik Kurir</h1>
            </div>
            <a href="scan.php" class="bg-white px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-2 active:scale-90 transition-transform">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#737373" stroke-width="2">
                    <path d="M3 7V5a2 2 0 012-2h2M17 3h2a2 2 0 012 2v2M21 17v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2"></path>
                    <rect x="7" y="7" width="10" height="10" rx="1"></rect>
                </svg>
                <span class="text-[#737373] text-[13px] font-medium font-jakarta">Scan</span>
            </a>
        </div>

        <div class="relative z-10 px-6 mt-10">
            <div class="bg-white rounded-xl p-1.5 flex gap-1 shadow-sm border border-gray-100">
                <button class="flex-1 py-2 rounded-lg text-gray-400 text-[14px] font-semibold">
                    Pickup
                </button>

                <button class="flex-1 py-2 rounded-lg shopee-bg text-white text-[14px] font-bold">
                    Delivery
                </button>
                <button class="flex-1 py-2 rounded-lg text-gray-400 text-[14px] font-semibold">
                    Selesai
                </button>
            </div>
        </div>

        <?php

        include '../sim_logistik/koneksi.php';

        $query = mysqli_query($koneksi, "
            SELECT pesanan.resi, pelanggan.nama AS nama_penerima, pesanan.alamat 
            FROM pesanan 
            JOIN pelanggan ON pesanan.id_penerima = pelanggan.id_pelanggan 
            WHERE pesanan.status = 'Picked Up' OR pesanan.status = 'Out for Delivery'
            ORDER BY pesanan.id_pesanan DESC
        ");

        $jumlah_paket = $query ? mysqli_num_rows($query) : 0;
        ?>

        <div class="flex-1 overflow-y-auto px-6 pt-6 pb-6 space-y-4 no-scrollbar">
            <div class="flex justify-between items-center mb-1">
                <h3 class="text-gray-800 font-bold text-[15px] font-jakarta">Pengantaran Hari Ini (<?= $jumlah_paket ?>)</h3>
            </div>

            <?php if ($jumlah_paket > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <div class="glass-card rounded-2xl p-4 flex flex-col gap-3 relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-blue-50 text-blue-600 text-[9px] font-bold px-3 py-1 rounded-bl-lg">Paket</div>

                        <div class="flex items-center gap-3">
                            <div class="w-[60px] h-[60px] bg-orange-50 rounded-xl flex items-center justify-center shrink-0 border border-orange-100">
                                <span class="text-2xl">📦</span>
                            </div>
                            <div class="flex-1 overflow-hidden pr-2">
                                <p class="text-[10px] text-gray-500 font-bold mb-0.5"><?= htmlspecialchars($row['resi']) ?></p>
                                <h2 class="text-[15px] font-bold text-gray-900 font-jakarta truncate"><?= htmlspecialchars($row['nama_penerima']) ?></h2>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <span class="text-[11px] font-medium text-orange-500 shrink-0">Siap Antar</span>
                                    <span class="text-gray-300">|</span>
                                    <span class="text-[11px] text-gray-500 truncate"><?= htmlspecialchars($row['alamat']) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-1">
                            <button class="flex-1 bg-gray-100 text-gray-600 py-2.5 rounded-lg text-[13px] font-bold">Detail</button>

                            <a href="navigate.php?resi=<?= $row['resi'] ?>" class="flex-[2] shopee-bg text-white py-2.5 rounded-lg text-[13px] font-bold flex items-center justify-center gap-2 shadow-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                </svg>
                                Navigate
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>

                <div class="text-center py-10 mt-10">
                    <span class="text-5xl opacity-30">📦</span>
                    <p class="text-gray-500 font-medium text-[14px] mt-4">Belum ada paket untuk diantar saat ini.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>

</html>